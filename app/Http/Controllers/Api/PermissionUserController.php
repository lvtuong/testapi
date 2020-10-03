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

    public function givePermission(Request $request)
    {
        return $this->userModel->givePermission($request);
    }

    public function checkPermission(Request $request)
    {
        return $this->userModel->checkPermission($request);
    }

    public function deletePermission(Request $request)
    {
        return $this->userModel->deletePermission($request);
    }
}
