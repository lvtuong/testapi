<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUpdateCategoriRequest;

use App\Http\Requests\UpdateCategori;
use App\Repositories\Categorie\CategorieRepositoryEloquent;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $categorieModel;
    public function __construct(CategorieRepositoryEloquent $categorieModel)
    {
        $this->categorieModel = $categorieModel;
    }

    public function index()
    {
        return $this->categorieModel->allCategorie();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUpdateCategoriRequest $request)
    {
        return $this->categorieModel->createCategorie($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->categorieModel->showCategorie($id);
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
    public function update(CreateUpdateCategoriRequest $request)
    {

        return $this->categorieModel->updateCategorie($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categorieModel->deleteCategorie($id);
    }
}
