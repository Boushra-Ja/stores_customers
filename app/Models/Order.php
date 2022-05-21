<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'delivery_time',
        'delivery_price',
        'status_id',
        'customer_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }

    public function rating()
    {
        return $this->hasOne(RatingOrder::class) ;
    }

    public function order_products()
    {
        return $this->belongsToMany(Product::class) ;
    }
}

