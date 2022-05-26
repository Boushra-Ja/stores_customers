<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'prepration_time',
        'party',
        'discription',
        'image',
        'age',
        'selling_price',
        'cost_price',
        'number_of_sales',
        'return_or_replace',
        'discount_products_id',
        'collection_id',

    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }

    public function discount()
    {
        return $this->belongsTo(DiscountProduct::class, 'discount_products_id');
    }

    public function raise()
    {
        return $this->hasOne(Raise::class) ;
    }

    public function discountProduct()
    {
        return $this->hasOne(DiscountProduct::class) ;
    }

    public function classificatios()
    {
        return $this->belongsToMany(Classification::class , 'classification_products') ;
    }

    public function options()
    {
        return $this->hasMany(OptionType::class , 'product_id');
    }

    public function options_product()
    {
        return $this->belongsToMany(OptioinValue::class , 'product_options') ;
    }

    public function order_products()
    {
        return $this->belongsToMany(Order::class , 'order_products') ;
    }

    public function favourits()
    {
        return $this->belongsToMany(Customer::class , 'customer_id') ;
    }
}
