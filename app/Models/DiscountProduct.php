<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'apply_to',
        'discounts_id',

    ];
    public function product()
    {
        return $this->hasMany(Product::class , 'discount_products_id');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class  , 'discounts_id') ;
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class , 'discount_products_id');
    }
}
