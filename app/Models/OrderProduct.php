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
        'amount'

    ];


    public function product_values()
    {
        return $this->belongsToMany(OptioinValue::class , 'product_options') ;
    }


  public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');

    }
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }


}
