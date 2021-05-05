<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    public function Car(){
        return $this->belongsTo('App\Car');
    }
}
