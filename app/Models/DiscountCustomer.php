<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_codes_id',
        'customers_id',
        'usage_times'
    ];
}
