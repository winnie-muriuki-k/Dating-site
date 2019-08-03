<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    //
    public function viewerUser()
    {
        return $this->belongsTo(User::class, 'viewer');
    }

    public function recipientUser ()
    {
        return $this->belongsTo(User::class, 'recipient');
    }
}
