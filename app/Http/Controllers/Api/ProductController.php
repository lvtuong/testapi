<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUpdateProductResquest;
use App\Models\Products;
use App\Repositories\Product\ProductRepositoryEloquent;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Products[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    protected $productModel;

    public function __construct(ProductRepositoryEloquent $productModel)
    {
        $this->middleware('permission:create product', ['only' => ['store']]);
        $this->middleware('permission:delete product', ['only' => ['delete']]);
//        $this->middleware('permission:create product|edit product', ['only' => ['create', 'store']]);

        $this->productModel = $productModel;
    }

    public function index(Request $request)
    {
        return $this->productModel->allProduct($request['page']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function store(CreateUpdateProductResquest $request)
    {
        return $this->productModel->createProduct($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        dd('asd');
        return $this->productModel->showProduct($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUpdateProductResquest $request)
    {
        return $this->productModel->updateProduct($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        return $this->productModel->deleteProduct($id);
    }
}
