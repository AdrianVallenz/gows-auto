<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * fillabe 
     *
     * @var array
     */

    protected $fillable = [
        'image',
        'title',
        'description',
        'price',
        'stock',
    ];
}
