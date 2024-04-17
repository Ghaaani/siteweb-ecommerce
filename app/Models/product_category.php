<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_category extends Model
{
    use HasFactory;
    protected $filliable =[

        'id',
        'name',
        'description',
        'created_at',
        'updated_at'

    ];
}