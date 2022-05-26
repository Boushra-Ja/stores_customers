<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class StoreManager extends Model
{



    use HasFactory;

    protected $fillable = [
       'privilladge',
       'store_id',
        'person_id',
    ];

    public function persone()
    {
        return $this->belongsTo(Persone::class  , 'persone_id') ;
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }



}
