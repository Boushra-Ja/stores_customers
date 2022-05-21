<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class , 'status_id');
    }
}
