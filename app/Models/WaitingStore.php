<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaitingStore extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id'
    ];

    public function storeManager()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
