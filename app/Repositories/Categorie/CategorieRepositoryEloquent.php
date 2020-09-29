<?php

namespace App\Repositories\Categorie;

use App\Models\Categories;
use Illuminate\Container\Container as Application;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Validators\Categorie\CategorieValidator;

/**
 * Class CategorieRepositoryEloquent.
 *
 * @package namespace App\Repositories\Categorie;
 */
class CategorieRepositoryEloquent extends BaseRepository implements CategorieRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    protected $categorieModel;

    public function __construct(Application $app, Categories $categorieModel)
    {
        $this->categorieModel = $categorieModel;
        parent::__construct($app);
    }

    public function allCategorie()
    {
        return $this->categorieModel::all();
    }

    public function createCategorie($data)
    {
        $slug = $data['name'];
        $slug = str_replace(' ', '-', $slug);
        return $this->categorieModel::create([
            'name' => $data['name'],
            'slug' => $slug,
            'description' => $data['description'],
        ]);
    }

    public function showCategorie($id)
    {
//        return $cate = $this->categorieModel::findOrFail($id)->products()->get();
        $cate = $this->categorieModel::findOrFail($id)->products()->get();
        return $cate;
    }

    public function updateCategorie($data)
    {

        $update = $this->categorieModel::find($data['id']);
        $slug = $data['name'];
        $slug = str_replace(' ', '-', $slug);

        return $update->update([
            'name' => $data['name'],
            'slug' => $slug,
            'description' => $data['description'],
        ]);


    }

    public function deleteCategorie($id)
    {
        $delete = $this->categorieModel::find($id);
        $delete->delete();
    }

    public function model()
    {
        return Categories::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
