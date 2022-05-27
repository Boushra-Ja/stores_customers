<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingStore extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'store_id',
        'notes',
        'value'
    ];

}
