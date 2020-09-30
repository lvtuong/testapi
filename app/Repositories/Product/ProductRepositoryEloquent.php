<?php

namespace App\Repositories\Product;

use App\Models\Products;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Product\ProductRepository;

use App\Validators\Product\ProductValidator;

/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace App\Repositories\Product;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Products::class;
    }

    protected $productModel;

    public function __construct(Products $productModel)
    {
        $this->productModel = $productModel;
    }

    public function allProduct($pageNumber)
    {
        $limit = 5;
        $offset = ($pageNumber - 1) * $limit;
        $model = $this->productModel::skip($offset)->take($limit)->get();
        return $model;
//        $product = $this->productModel::Paginate(3, ['*'], 'page', $pageNumb>
//
//        return $product->setPath('url');

    }

    public function showProduct($id)
    {
        return $this->productModel::findOrFail($id);
    }

    public function createProduct($data)
    {
        $slug = $data['name'];
        $slug = str_replace(' ', '-', $slug);
        $this->productModel::create([
            'name' => $data['name'],
            'slug' => $slug,
            'description' => $data['description'],
            'sku' => $data['sku'],
            'price' => $data['price'],
        ]);
        // get product_id
//        $product = $this->productModel::where('name', $data['name'])->get();
//        foreach ($product as $d ){
//            $product_id = $d->id;
//        }
//        // add table pivot->product_id
//        $cate = $this->productModel::find($product_id);
//        $cate->categories()->attach(7);
    }

    public function updateProduct($data)
    {

        $update = $this->productModel::find($data['id']);
        $slug = $data['name'];
        $slug = str_replace(' ', '-', $slug);

        return $update->update([
            'name' => $data['name'],
            'slug' => $slug,
            'description' => $data['description'],
            'sku' => $data['sku'],
            'price' => $data['price'],
        ]);
    }

    public function deleteProduct($id)
    {
        $delete = $this->productModel::find($id);
        return $delete->delete();
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
