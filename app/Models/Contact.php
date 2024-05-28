<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Contact extends Eloquent
{
    protected $table = 'contacts';

    protected $fillable = [
        'user_id',
        'address_id', 
        'phone_id',
        'name',
        'email',
    ];
}


