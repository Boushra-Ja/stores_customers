<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'store_manager_id',
    ];

    public function storeManager()
    {
        return $this->belongsTo(StoreManager::class, 'store_manager_id');
    }

    public function privilladge()
    {
        return $this->belongsToMany(Privilladge::class,'privilladge_helpers','helper_id','privilladge_id') ;
    }
}
