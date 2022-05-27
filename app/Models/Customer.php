<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'persone_id',
    ];

    public function persone()
    {
        return $this->belongsTo(Persone::class  , 'persone_id') ;
    }

    public function orders()
    {
        return $this->hasMany(Order::class , 'customer_id');
    }

    public function favourit_products()
    {
        return $this->belongsToMany(Product::class) ;
    }

    public function favourit_stors()
    {
        return $this->belongsToMany(Store::class) ;
    }

    public function rating_store()
    {
        return $this->belongsToMany(Store::class) ;
    }

    public function report_stors()
    {
        return $this->belongsToMany(Store::class) ;
    }

    public function discount_codes()
    {
        return $this->belongsToMany(DiscountCode::class , 'discount_customers') ;
    }

    public function rating_products()
    {
        return $this->belongsToMany(Product::class) ;
    }

}
