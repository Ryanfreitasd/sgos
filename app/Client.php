<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    function cliente(){
        return $this->hasMany('App\Ticket');
    }
}
