<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable = [
        'id','approved_by','user_id','returned_to','projector_id'
    ];

    public function approved()
    {
        return $this->belongsTo(User::class,'approved_by','id');
    }
    public function booker()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function projector()
    {
        # code...
        return $this->belongsTo(Projector::class);
    }

    public function returnedTo(){
        return $this->belongsTo(User::class,'returned_to','id');
    }
}
