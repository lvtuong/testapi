<?php

namespace App\Repositories\PermissionRole;

use App\Models\User;
use http\Env\Response;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PermissionRole\PermissonRoleRepository;
use App\Validators\PermissionRole\PermissonRoleValidator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Class PermissonRoleRepositoryEloquent.
 *
 * @package namespace App\Repositories\PermissionRole;
 */
class PermissonRoleRepositoryEloquent extends BaseRepository implements PermissonRoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    protected $user;

    public function __construct(Application $app, User $user)
    {
        $this->user = $user;
        parent::__construct($app);
    }

    public function model()
    {
        return User::class;
    }

    /**
     * PERMISSION
     * @param $request
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */

    public function createPermissionUser($request)
    {
        return Permission::create(['name' => $request['permission']]);
    }

    public function givePermissionUser($request)
    {

        $user = $this->user::find($request['id']);
        $permission = $user->givePermissionTo($request['permission']);

        return response()->json(['permission' => $permission], 200);

    }

    public function checkPermissionUser($request)
    {
        $user = User::find($request['id']);
        if ($user) {
            $permission = $user->getAllPermissions();
            if ($permission) {

                return response()->json(['permission' => $permission], 200);

            } else {

                return response()->json(['error' => "not permission "], 422);

            }
        } else {
            $error = "user not found";
            return response()->json(['error' => $error]);
        }


    }

    public function deletePermissionUser($request)
    {
        $user = $this->user::find($request['id']);
        return $permission = $user->revokePermissionTo($request['permission']);
    }

    public function addPermissionToRole($request)
    {
        $role = Role::findByName($request['role']);
        $permission = Permission::findByName($request['permission']);

        return $role->givePermissionTo($permission);
//        $permission->assignRole($role);

    }

    public function remotePermissionRole($request)
    {
        //check role & permission
        $role = Role::all()->where('name', $request['role']);
        $permission = Permission::all()->where('name', $request['permission']);
        if ($role->isEmpty() == true) {
            return response()->json(['error' => "not role"], 422);
        } else {

            if ($permission->isEmpty() == true) {
                return response()->json(['error' => "permission not found"], 422);
            }
            //remote permission from role;
            $role = Role::findByName($request['role']);
            $permission = Permission::findByName($request['permission']);

            return response()->json(['success' => "remote ok", $role->revokePermissionTo($permission)]);
        }
    }
    /**
     * END PERMISSION
     */


    /**
     * ROLE
     * @param $request
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */

    public function createRoleUser($request)
    {
        return Role::create(['name' => $request['role']]);
    }

    public function giveRoleUser($request)
    {
        $user = $this->user::find($request['id']);

        $role = $request['role'];

        $check_role = Role::all()->where('name', $role);
        //check role

        if ($user) {
            if ($check_role->isEmpty() == true) {
                $error = "role not found";
                return response()->json(['error' => $error], 422);
            } else {
                $role = Role::findByName($role);
                $user->assignRole($role);

                return response()->json(['role' => $user], 200);
            }
        } else {
            $error = "user not found";
            return response()->json(['error' => $error], 422);
        }
    }

    public function checkRoleUser($request)
    {
        $user = User::find($request['id']);
        if ($user) {
            $user = $user->roles;
            if ($user->isEmpty()) {
                $error = "user not role";

                return response()->json($error, 422);

            } else {
                foreach ($user as $role) {

                    return response()->json(['role' => $role->name], 200);
                }
            }
        } else {
            $error = "user not found";
            return response()->json(['error' => $error], 422);
        }
    }

    /**
     * END ROLE
     */


    /**
     * Boot up the repository, pushing criteria
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
