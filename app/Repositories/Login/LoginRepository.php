<?php

namespace App\Repositories\Login;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface LoginRepository.
 *
 * @package namespace App\Repositories\Login;
 */
interface LoginRepository extends RepositoryInterface
{
    public function register($request);

    public function login($request);

    public function logout($request);

    public function getUser($request);



}
