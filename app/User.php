<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ROLE_NORMAL = 'normal';
    const ROLE_GOVERNMENT = 'government';
    const ROLE_POLICE = 'police';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function license(){
        $this->hasOne(License::class);
    }

    public function isGovernment(){
        return $this->role == self::ROLE_GOVERNMENT;
    }

    public function isPolice(){
        return $this->role == self::ROLE_POLICE;
    }


}
