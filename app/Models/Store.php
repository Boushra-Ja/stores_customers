<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'delivery_area',
        'discription',
        'image',
        'num_of_salling',
        'facebook',
        'mobile',
        'status'
    ];

    public function collectios()
    {
        return $this->hasMany(Collection::class , 'store_id');
    }

    public function favourits()
    {
        return $this->belongsToMany(Customer::class , 'favorite_stores') ;
    }


    public function rating()
    {
        return $this->belongsToMany(Customer::class , 'rating_stores') ;
    }

    public function reports()
    {
        return $this->belongsToMany(Customer::class , 'reports') ;
    }



    public function managers()
    {
        return $this->hasMany(StoreManager::class , 'store_id');
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class , 'store_id');
    }


}
