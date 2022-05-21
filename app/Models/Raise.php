<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Raise extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'date',
        'status',
        'product_id',

    ];

    public function product()
    {
        return $this->belongsTo(Product::class  , 'product_id') ;
    }
}
