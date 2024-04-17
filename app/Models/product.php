<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $filliable =[

        'id',
        'name',
        'description' ,
        'SKU',
        'category_id',
        'inventory_id',
        'price',
        'discount_id',
        'created_at',
        'updated_at',
        'image'

    ];
}
