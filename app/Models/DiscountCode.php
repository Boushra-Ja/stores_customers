<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'usage_times',
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
        return $this->belongsToMany(Customer::class ) ;
    }
}
