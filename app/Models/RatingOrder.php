<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RatingOrder extends Model
{
    use HasFactory;
    protected $table = 'rating_products';

    protected $fillable = [
        'order_id',
        'smile',
        'notes'
    ];


    public function order()
    {
        return $this->belongsTo(RatingOrder::class  , 'order_id') ;
    }

}

