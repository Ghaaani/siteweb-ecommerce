<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    use HasFactory;

    protected $filliable =[

        'id',
        'adresse',
        'number',
        'email',
        'created_at',
        'updated_at'

    ];
}
