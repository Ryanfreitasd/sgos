<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    function ticket(){
        return $this->hasMany('App\Ticket');
    }
}
