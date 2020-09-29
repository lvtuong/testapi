<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description','sku','price'
    ];

    public function categories()
    {
        return $this->belongsToMany(Categories::class,
            'categorie_product',
            'product_id',
            'categorie_id');
    }
}
