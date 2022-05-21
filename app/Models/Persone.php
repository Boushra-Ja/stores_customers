<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'email',
        'password',

    ];

    public function customer()
    {
        return $this->hasOne(Customer::class) ;
    }

    public function store_manager()
    {
        return $this->hasOne(StoreManager::class) ;
    }

    public function notifications_send()
    {
        return $this->belongsToMany(Persone::class , 'notifications') ;
    }

    public function notifications_recive()
    {
        return $this->belongsToMany(Persone::class) ;
    }

    public function messages_send()
    {
        return $this->belongsToMany(Chat::class , 'chats') ;
    }

    public function messages_recieve()
    {
        return $this->belongsToMany(Chat::class) ;
    }
}
