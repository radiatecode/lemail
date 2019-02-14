<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * Generate User List Except The Logged In One
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder[]|
     * \Illuminate\Database\Eloquent\Collection|
     * \Illuminate\Database\Query\Builder[]|
     * \Illuminate\Support\Collection
     */
    public static function userListExceptAuthOne($id){
        return static::query()
            ->whereNotIn('id',[$id])
            ->orderBy('name','ASC')
            ->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function send_message(){
        return $this->hasMany('App\Sender','sender_id','id');
    }

    /**
     * a user can receive many messages
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function message_receiver(){
        return $this->belongsToMany(
            'App\Message',
            'receivers',
            'receiver_id',
            'message_id')
            ->orderBy('receivers.id','DESC')
            ->whereNull('receivers.deleted_at')
            ->withPivot(['id','read_at']);
    }

    public function log(){
        return $this->hasMany('App\Log','user_id','id');
    }

}
