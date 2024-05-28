<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\User;

class Phone extends Eloquent
{
    protected $table = 'phones';

    protected $fillable = [
        'contact_id',
        'number'
    ];

    // public function users() {

    //     return $this->belongsTo(User::class, 'user_id');
    // }
}


