<?php

namespace App\Repositories\Login;

use App\Models\User;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Login\LoginRepository;
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


    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login($request)
    {
        $user = $this->user::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('token')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" => 'User does not exist'];
            return response($response, 422);
        }
    }

    public function logout($request)
    {
        $is_user = $request->user()->token()->revoke();

        if ($is_user) {
            $success['message'] = "Successfully logged out.";

            return response()->json($success, 200);
        } else {
            $error = "Something went wrong.";

            return response()->json($error);
        }
    }

    public function getUser($request)
    {
        $user = $request->user();
        $user->roles;
        if ($user) {
            return response()->json($user, 200);
        } else {
            $error = "user not found";

            return response()->json($error);
        }
    }


    /**
     * Boot up the repository, pushing criteria
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
