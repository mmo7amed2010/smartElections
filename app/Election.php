<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
        protected $hidden = [
        'name', 'address','national_id', 'status'
    ];
}
