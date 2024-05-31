<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\Contact;

class User extends Eloquent
{
    protected $table = 'users';

    protected $fillable = [
        'name', 
        'email',
        'password'
    ];

    protected $hidden = ['password'];

    public function contacts() {

        return $this->hasMany(Contact::class)->orderBy('name', 'asc');
    }
}


