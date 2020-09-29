<?php

namespace App\Repositories\Login;

use App\Models\User;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Validators\Login\LoginValidator;

/**
 * Class LoginRepositoryEloquent.
 *
 * @package namespace App\Repositories\Login;
 */
class LoginRepositoryEloquent extends BaseRepository implements LoginRepository
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

    public function register($data)
    {
        $user = $this->user::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    public function login($request)
    {
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            $error = "Unauthorized";
            return $this->sendError($error, 401);
        }
        $user = $request->user();
        $success['token'] = $user->createToken('token')->accessToken;

        return $this->sendResponse($success);
    }

    public function logout($request)
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

    public function getUser($request)
    {
        $user = $request->user();
        if ($user) {

            return $this->sendResponse($user);
        } else {
            $error = "user not found";

            return $this->sendResponse($error);
        }
    }


    public function sendError($error, $code = 404)
    {
        $response = [
            'error' => $error,
            'code' => $code
        ];
        return response()->json($response, $code);
    }

    public function sendResponse($response)
    {
        return response()->json($response, 200);
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
