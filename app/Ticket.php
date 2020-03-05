<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Ticket extends Model
{
    protected $table = "tickets";

    public function getDeliveryDateAttribute($value)
    {
       return Carbon::createFromDate($value)->format('d/m/Y');        
    }
    
    function priority(){
        return $this->belongsTo('App\Priority');
    }

    function status(){
        return $this->belongsTo('App\Status');
    }

    function user(){
        return $this->belongsTo('App\User');
    }

    function client(){
        return $this->belongsTo('App\Client');
    }


}
