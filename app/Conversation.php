<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model
{
	use SoftDeletes;
    //
    /**
     * Message belongs to Sender.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personOne()
    {
    	// belongsTo(RelatedModel, foreignKey = sender_id, keyOnRelatedModel = id)

    	return $this->belongsTo('App\User','person_one');
    }

    /**
     * Message belongs to Receiver.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personTwo()
    {
    	// belongsTo(RelatedModel, foreignKey = receiver_id, keyOnRelatedModel = id)
    	return $this->belongsTo('App\User','person_two');
    }
    /**
     * Conversation has many Messages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = conversation_id, localKey = id)
    	return $this->hasMany(Message::class,'conversation_id');
    }
}
