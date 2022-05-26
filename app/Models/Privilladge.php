<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilladge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function storeManager()
    {
        return $this->belongsToMany(StoreManager::class,'privilladge_store_managers','privilladge_id','store_manager_id','id','id') ;
    }
}
