<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'role', 'points', 'photo', 'password', 'google_id'
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

    public function charity() {
        return $this->hasOne('App\Charity');
    }

    public function philanthropist() {
        return $this->hasOne('App\Philanthropist');
    }

    public function company() {
        return $this->hasOne('App\Company');
    }

    public function watch_log() {
        return $this->hasMany('App\WatchLog');
    }
}
