<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'its_for',
        'discount_code',
        'discounts_id',
    ];

    public function discount()
    {
        return $this->belongsTo(Discount::class  , 'discounts_id') ;
    }

    public function Customers()
    {
        return $this->belongsToMany(Customer::class,'discount_customers','discount_codes_id','customers_id','id','id' ) ;
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class , 'discount_codes_id');
    }
}
