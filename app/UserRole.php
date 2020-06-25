<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    //
    protected $fillable = [
        'id','user_id','role_id'
    ];
}
