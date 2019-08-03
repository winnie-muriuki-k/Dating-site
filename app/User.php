<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','gender','age','avatar'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * User has many Matches.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function match()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = id)
        return $this->hasOne(Matches::class,'recipient');
    }
    public function other_match()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = id)
        return $this->hasOne(Matches::class,'initator');
    }
    public function profileVisits()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = id)
        return $this->hasOne(ProfileVisit::class,'user_id');
    }

    public function seeking(){
        return $this->belongsTo(Gender::class, 'seeking_id');
    }
    /**
     * User has many Messages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = id)
        return $this->hasMany(Message::class,'sender');
    }
    public function profile(){
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function hobbies()
    {
        return $this->hasMany(UserHobby::class, 'user_id');
    }
    public function music()
    {
        return $this->hasMany(UserMusicType::class, 'user_id');
    }
    public function foods()
    {
        return $this->hasMany(UserFood::class, 'user_id');
    }
    public function sports()
    {
        return $this->hasMany(UserSport::class, 'user_id');
    }
    public function myFavourites ()
    {
        return $this->hasMany(Favourite::class, 'initiator_id');
    }

    public function favouritedMe()
    {
        return $this->hasMany(Favourite::class, 'recipient_id');
    }



}
