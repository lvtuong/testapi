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
    public function createPermissionUser($request);
    public function givePermissionUser($request);
    public function checkPermissionUser($request);
    public function deletePermissionUser($request);
    public function addPermissionToRole($request);
    public function remotePermissionRole($request);

    //===============role==========//
    public function createRoleUser($request);
    public function giveRoleUser($request);
    public function checkRoleUser($request);


}
