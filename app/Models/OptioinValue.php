<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptioinValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'product_id',

    ];

    public function option_type()
    {
        return $this->belongsTo(OptionType::class, 'option_type_id');
    }

    public function order_products()
    {
        return $this->belongsToMany(OrderProduct::class) ;
    }
}
