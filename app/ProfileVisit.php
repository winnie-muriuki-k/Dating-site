<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileVisit extends Model
{
	protected $table ="profileVisits";

	protected $fillable = ['user_id','count'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
