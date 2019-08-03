<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
	// use SoftDeletes;

    /**
     * Message has many Replies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = message_id, localKey = id)
    	return $this->hasMany(Reply::class);
    }
    /**
     * Message belongs to Conversation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conversation()
    {
        // belongsTo(RelatedModel, foreignKey = conversation_id, keyOnRelatedModel = id)
        return $this->belongsTo(Conversation::class,'conversation_id');
    }

    /**
     * Message belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        // belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
        return $this->belongsTo(User::class,'sender_id');
    }
    /**
     * Message belongs to Sender.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function senderPerson()
    {
        // belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
        return $this->belongsTo(User::class,'sender_id');
    }
    /**
     * Message belongs to Receiver.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiverPerson()
    {
        // belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
        return $this->belongsTo(User::class,'receiver_id');
    }
}
