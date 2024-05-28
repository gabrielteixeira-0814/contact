<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\User;

class Contact extends Eloquent
{
    protected $table = 'contacts';

    protected $fillable = [
        'user_id',
        'name',
        'email',
    ];

    public function users() {

        return $this->belongsTo(User::class, 'user_id');
    }
}


