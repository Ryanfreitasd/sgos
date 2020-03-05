<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    function ticket(){
        return $this->hasMany('App\Ticket');
    }
}
