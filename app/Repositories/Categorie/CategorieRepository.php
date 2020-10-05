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
    public function allCategories();
    public function createCategories($data);
    public function showCategories($id);
    public function updateCategories($data);
    public function deleteCategories($id);

}
