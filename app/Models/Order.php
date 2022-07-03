<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'delivery_time',
        'delivery_price',
        'store_id',
        'customer_id',
        'discount_codes_id'
    ];


    public function order_products()
    {
        return $this->belongsToMany(Product::class,'order_products') ;
    }

    public function discount_code()
    {
        return $this->belongsTo(DiscountCode::class, 'discount_codes_id');
    }

}

