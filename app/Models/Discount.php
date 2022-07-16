<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'value',
        'start_date',
        'end_date',
        'store_id',

    ];

    public function code()
    {
        return $this->hasOne(DiscountCode::class) ;
    }

    public function product()
    {
        return $this->hasOne(DiscountProduct::class) ;
    }

    public function store()
    {
        return $this->belongsTo(Store::class  , 'store_id') ;
    }
}
