<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockedUser extends Model
{
	protected $table= "blockedUsers";

	/**
	 * Fields that can be mass assigned.
	 *
	 * @var array
	 */
	protected $fillable = ['admin_id','user_id','reasons'];

    //
    /**
     * BlockedUser belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function suspect()
    {
    	// belongsTo(RelatedModel, foreignKey = suspect_id, keyOnRelatedModel = id)
    	return $this->belongsTo(User::class,"suspect_id");
    }

    /**
     * BlockedUser belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
    	// belongsTo(RelatedModel, foreignKey = admin_id, keyOnRelatedModel = id)
    	return $this->belongsTo(User::class,"admin_id");
    }
}
