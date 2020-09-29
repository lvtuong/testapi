<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Login\LoginRepositoryEloquent;
use Validator;
use Illuminate\Http\Request;


class PassportAuthController extends Controller
{
    /**
     * Register
     */
    protected $userModel;

    public function __construct(LoginRepositoryEloquent $userModel)
    {
        $this->userModel = $userModel;
    }

    public function register(RegisterRequest $request)
    {
        return $this->userModel->register($request->all());
    }

    /**
     * Login
     */
    public function login(LoginRequest $request)
    {
        return $this->userModel->login($request);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        return $this->userModel->logout($request);
    }

    /**
     * GetInforUser
     */
    public function getUser(Request $request)
    {
        return $this->userModel->getUser($request);
    }
}
