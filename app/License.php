<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{

    protected $fillable = [
        'user_id','address', 'point',
    ];

    public function User(){
        $this->hasOne(User::class);
    }

}
