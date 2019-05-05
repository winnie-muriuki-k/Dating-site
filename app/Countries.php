<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    //cities
    public function cities()
    {
       return $this->hasMany(Cities::class, 'country_id');
    }
}
