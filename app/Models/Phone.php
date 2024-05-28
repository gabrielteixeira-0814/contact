<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\User;
use App\Models\Contact;

class Phone extends Eloquent
{
    protected $table = 'phones';

    protected $fillable = [
        'contact_id',
        'number'
    ];

    public function contacts() {

        return $this->belongsTo(Contact::class, 'contact_id');
    }
}


