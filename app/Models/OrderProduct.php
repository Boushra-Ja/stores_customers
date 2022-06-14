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
        'status_id'

    ];


    public function product_values()
    {
        return $this->belongsToMany(OptioinValue::class , 'product_options') ;
    }


  public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }


}
