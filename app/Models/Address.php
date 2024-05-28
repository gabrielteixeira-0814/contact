<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\User;
use App\Models\Contact;

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

    public function contacts() {

        return $this->belongsTo(Contact::class, 'contact_id');
    }
}


