<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart_item extends Model
{
    use HasFactory;

    protected $filliable =[

        'id',
        'product_id',
        'name',
        'prix',
        'quantity',
        'created_at',
        'updated_at'

    ];
}
