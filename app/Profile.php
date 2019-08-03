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
    public function hairLength()
    {
        return $this->belongsTo(HairLength::class, 'hair_length_id');
    }
    public function height ()
    {
        return $this->belongsTo(Height::class, 'height_id');
    }

    public function weight ()
    {
        return $this->belongsTo(Weight::class, 'weight_id');
    }

    public function bodyType ()
    {
        return $this->belongsTo(BodyType::class, 'body_type_id');
    }

    public function ethnicity ()
    {
        return $this->belongsTo(Ethnicity::class, 'ethnicity_id');

    }
    public function complexion ()
    {
        return $this->belongsTo(Complexion::class, 'complexion_id');
    }

    public function facialHair ()
    {
        return $this->belongsTo(FacialHairTypes::class, 'facial_hair_type_id');
    }

    public function bestFeature ()
    {
        return $this->belongsTo(BestFeature::class, 'best_feature_id');
    }

    public function bodyArt ()
    {
        return $this->belongsTo(BodyArt::class, 'body_art_id');
    }

    public function beautyLevel ()
    {
        return $this->belongsTo(BeautyLevels::class, 'beauty_level_id');
    }
    public function seeking ()
    {
        return $this->belongsTo(Gender::class, 'seeking_id');
    }
}
