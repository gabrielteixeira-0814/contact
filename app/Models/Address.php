<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Address extends Eloquent
{
    protected $table = 'address';

    protected $fillable = [
        'user_id', 
        'number',
        'public_place',
        'neighborhood',
        'city',
        'state'
    ];
}


