<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{

    protected $fillable = [
        'order_product_id',
        'option_values_id'];

    use HasFactory;
}
