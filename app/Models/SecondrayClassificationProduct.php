<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecondrayClassificationProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'secondary_id'
    ];
}
