<?php

namespace App\Repositories\Login;

use App\Models\User;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Login\LoginRepository;
use App\Entities\Login\Login;
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
            return response()->json($error, 401);
        }
        $user = $request->user();
        $success['token'] = $user->createToken('token')->accessToken;

        return response()->json($success, 200);
    }

    public function logout($request)
    {
        $isUser = $request->user()->token()->revoke();

        if ($isUser) {
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
        if ($user) {

            return response()->json($user, 200);
        } else {
            $error = "user not found";

            return response()->json($error);
        }
    }
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
