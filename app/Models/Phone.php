<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Phone extends Eloquent
{
    protected $table = 'phones';

    protected $fillable = [
        'user_id',
        'number'
    ];
}

