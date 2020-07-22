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
    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function isBooked($bookings)
    {
        // var_dump($bookings);
        // die();
        foreach($bookings as $booking){
            if($booking->returned_to == false and $booking->approved_by > 0){
                return true;
            }
        }
        return false;
    }

    public function available(){
        return $this->hasOne(Booking::class)->where(["returned_to"=>0])->where("approved_by",">",0);
    }

    public function requests(){
        return $this->hasMany(Booking::class)->where("approved_by",0);
    }

}
