<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description',
    ];
    public function products()
    {
        return $this->belongsToMany(Products::class,
            'categorie_product',
            'categorie_id',
            'product_id');
    }
}
