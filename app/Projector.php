<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projector extends Model
{
    //
    protected $fillable =[
        'id','name','serial','booking_duration','department_id'
    ];

    public function department()
    {
        return  $this->belongsTo(Department::class);
    }

}
