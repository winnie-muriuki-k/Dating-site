<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //relations
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id');
    }

    public function city()
    {
        return $this->belongsTo(Cities::class, 'city_id');
    }

    public function hairColor()
    {
        return $this->belongsTo(HairColor::class, 'hair_color_id');
    }

    public function hairType()
    {
        return $this->belongsTo(HairType::class, 'hair_type_id');
    }

    Public function eyeColor()
    {
        return $this->belongsTo(EyeColor::class, 'eye_color_id');
    }

    public function eyeWear()
    {
        return $this->belongsTo(EyeWear::class, 'eye_wear_id');
    }
}
