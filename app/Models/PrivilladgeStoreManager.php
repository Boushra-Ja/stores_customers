<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivilladgeStoreManager extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_manager_id',
        'privilladge_id',
    ];
}
