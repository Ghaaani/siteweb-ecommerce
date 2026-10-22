<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'checkout_id',
        'product_id',
        'name',
        'prix',
        'quantity',
    ];

    public function checkout()
    {
        return $this->belongsTo(checkout::class, 'checkout_id');
    }
}
