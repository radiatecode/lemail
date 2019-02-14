<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $hidden = ['updated_at'];

    /**
     * a Message has Many Recipient
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function recipients(){
        return $this->belongsToMany(
            'App\User',
            'receivers',
            'message_id',
            'receiver_id')
            ->withPivot(['id','read_at']);
    }

    /**
     * A Message Has One Sender
     * @return mixed
     */
    public function sender(){
        return $this->hasOne('App\Sender','message_id','id')->withTrashed();
    }

}
