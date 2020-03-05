<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    function usuario(){
        return $this->hasMany('App\User');
    }
}
