<?php

namespace App\Repositories\PermissionRole;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PermissonRoleRepository.
 *
 * @package namespace App\Repositories\PermissionRole;
 */
interface PermissonRoleRepository extends RepositoryInterface
{
    //==========permission=========//
    public function createPermission($request);
    public function givePermission($request);
    public function checkPermission($request);
    public function deletePermission($request);

    //===============role==========//
    public function createRoleUser($request);
    public function giveRoleUser($request);
    public function checkRoleUser($request);


}
