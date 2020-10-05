<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Login\LoginRepositoryEloquent;
use App\Repositories\PermissionRole\PermissonRoleRepositoryEloquent;
use Illuminate\Http\Request;

class PermissionUserController extends Controller
{
    protected $userModel;

    public function __construct(PermissonRoleRepositoryEloquent $userModel)
    {
        $this->userModel = $userModel;
    }

    public function CreatePermissionUser(Request $request)
    {
        return $this->userModel->createPermission($request);
    }

    public function givePermissionUser(Request $request)
    {
        return $this->userModel->givePermissionUser($request);
    }

    public function checkPermissionUser(Request $request)
    {
        return $this->userModel->checkPermissionUser($request);
    }

    public function deletePermissionUser(Request $request)
    {
        return $this->userModel->deletePermissionUser($request);
    }

    public function addPermissionToRole(Request $request)
    {
        return $this->userModel->addPermissionToRole($request);
    }

    public function remotePermissionRole(Request $request)
    {
        return $this->userModel->remotePermissionRole($request);
    }
}
