<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CategorieProduct extends Pivot
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'categorie_product';
    protected $fillable = [
        'product_id', 'categorie_id',
    ];

}
