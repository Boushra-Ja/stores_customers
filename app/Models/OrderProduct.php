<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'status_id',
        'discount_products_id',
        'discount_codes_id'

    ];


    public function product_values()
    {
        return $this->belongsToMany(OptioinValue::class, 'product_options');
    }


    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }

    public function discount_product()
    {
        return $this->belongsTo(DiscountProduct::class, 'discount_products_id');
    }

    public function discount_code()
    {
        return $this->belongsTo(DiscountCode::class, 'discount_codes_id');
    }

}
