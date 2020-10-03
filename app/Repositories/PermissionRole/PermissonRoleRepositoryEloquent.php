<?php

namespace App\Repositories\PermissionRole;

use App\Models\User;
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

    public function createPermission($request)
    {
        return Permission::create(['name' => $request['permission']]);
    }

    public function givePermission($request)
    {

        $user = $this->user::find($request['id']);
        $permission = $user->givePermissionTo($request['permission']);

        return response()->json(['permission' => $permission], 200);

    }

    public function checkPermission($request)
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

    public function deletePermission($request)
    {
        $user = $this->user::find($request['id']);
        return $permission = $user->revokePermissionTo($request['permission']);
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
        //check role
        $roles = Role::findByName($role)->name;
        if ($roles) {
            $user->assignRole($role);

            return response()->json(['permission' => $user], 200);
        }
    }

    public function checkRoleUser($request)
    {
        $user = User::find($request['id']);
        if ($user) {
            $user = $user->roles;
            if ($user->isEmpty()) {
                $error = "user not role";

                return response()->json($error);

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
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
