<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class about_us extends Model
{
    use HasFactory;

    protected $filliable =[
        'id',
        'titre',
        'sous_titre',
        'image',
        'description',
        'created_at',
        'updated_at'
    ];
}
