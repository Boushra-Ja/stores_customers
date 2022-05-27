<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivilladgeHelper extends Model
{
    use HasFactory;
    protected $fillable = [
        'helper_id',
        'privilladge_id',
    ];
}
