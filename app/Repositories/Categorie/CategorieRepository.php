<?php

namespace App\Repositories\Categorie;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategorieRepository.
 *
 * @package namespace App\Repositories\Categorie;
 */
interface CategorieRepository extends RepositoryInterface
{
    public function allCategorie();
    public function createCategorie($data);
    public function showCategorie($id);
    public function updateCategorie($data);
    public function deleteCategorie($id);

}
