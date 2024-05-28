<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\User;
use App\Models\Phone;
use App\Models\Address;

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

    public function phones() {

        return $this->hasMany(Phone::class, 'contact_id');
    }

    public function address() {

        return $this->hasOne(Address::class, 'contact_id');
    }
}


