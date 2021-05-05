<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public function Part(){
        return $this->hasMany('App\Part');
    }
}
