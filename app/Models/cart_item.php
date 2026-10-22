<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'prix',
        'quantity',
    ];

    protected $appends = ['image', 'line_total'];

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }

    /**
     * The product image, so JSON payloads carry a usable image path.
     */
    public function getImageAttribute()
    {
        return $this->product?->image;
    }

    /**
     * Price multiplied by quantity.
     */
    public function getLineTotalAttribute()
    {
        return round((float) $this->prix * (int) $this->quantity, 2);
    }
}
