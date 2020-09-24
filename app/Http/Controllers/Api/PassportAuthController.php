<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassportAuthController extends ResponseController
{
    /**
     * Register
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            $error = "Unauthorized";

            return $this->sendError($error, 401);
        }
        $user = $request->user();
        $success['token'] = $user->createToken('token')->accessToken;

        return $this->sendResponse($success);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {

        $isUser = $request->user()->token()->revoke();
        if ($isUser) {
            $success['message'] = "Successfully logged out.";

            return $this->sendResponse($success);
        } else {
            $error = "Something went wrong.";

            return $this->sendResponse($error);
        }
    }

    /**
     * GetInforUser
     */
    public function getUser(Request $request)
    {
        $user = $request->user();
        if ($user) {

            return $this->sendResponse($user);
        } else {
            $error = "user not found";

            return $this->sendResponse($error);
        }
    }
}
