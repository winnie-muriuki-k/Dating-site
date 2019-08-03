<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    //
    /**
     * Matches belongs to Initiators.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function initiator()
    {
    	// belongsTo(RelatedModel, foreignKey = initiators_id, keyOnRelatedModel = id)
    	return $this->belongsTo(User::class,'initator');
    }
    //
    /**
     * Matches belongs to Initiators.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipient()
    {
    	// belongsTo(RelatedModel, foreignKey = initiators_id, keyOnRelatedModel = id)
    	return $this->belongsTo(User::class,'recipient');
    }
    /**
     * Matches belongs to Initiators.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_recipient()
    {
        // belongsTo(RelatedModel, foreignKey = initiators_id, keyOnRelatedModel = id)
        return $this->belongsTo(User::class,'recipient');
    }
    public function recipient_info()
    {
        // belongsTo(RelatedModel, foreignKey = initiators_id, keyOnRelatedModel = id)
        return $this->belongsTo(User::class,'recipient');
    }
    public function notification ()
    {
        return $this->belongsTo(Notification::class, 'notification_id');
    }
}
