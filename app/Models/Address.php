<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\User;

class Address extends Eloquent
{
    protected $table = 'address';

    protected $fillable = [
        'contact_id', 
        'number',
        'public_place',
        'neighborhood',
        'city',
        'state'
    ];

    // public function users() {

    //     return $this->belongsTo(User::class, 'user_id');
    // }
}


