<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\PermissionRole\PermissonRoleRepositoryEloquent;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    protected $userModel;

    public function __construct(PermissonRoleRepositoryEloquent $userModel)
    {
        $this->userModel = $userModel;
    }

    public function createRoleUser(Request $request)
    {

        return $this->userModel->createRoleUser($request);
    }

    public function giveRoleUser(Request $request)
    {
        return $this->userModel->giveRoleUser($request);
    }

    public function checkRoleUser(Request $request)
    {

        return $this->userModel->checkRoleUser($request);
    }

}
