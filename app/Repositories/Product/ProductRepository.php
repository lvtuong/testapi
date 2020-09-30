<?php

namespace App\Repositories\Product;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ProductRepository.
 *
 * @package namespace App\Repositories\Product;
 */
interface ProductRepository extends RepositoryInterface
{
    //
    public function allProduct($pageNumber);
    public function showProduct($id);
    public function createProduct($data);
    public function updateProduct($data);
    public function deleteProduct($id);


}
