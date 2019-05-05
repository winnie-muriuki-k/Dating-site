<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Model
{
	use SoftDeletes;
    //

    /**
     * Reply belongs to Message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function message()
    {
    	// belongsTo(RelatedModel, foreignKey = message_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Message::class);
    }

}
