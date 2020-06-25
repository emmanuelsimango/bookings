<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = [
        'id','name'
    ];

    function users(){
        return $this->hasMany(User::class,'user_roles');
    }
}
