<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Projector;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = array(
            'bookings' => Booking::count(),
            'users'=>User::count(),
            'projectors'=>Projector::count(),
            'booked_projectors'=> Booking::where(['returned_to'=>'0'])->orderBy('id','desc')->get(),
            'available_projectors'=>Projector::orderBy('name')->get()
        );
        foreach($data['available_projectors'] as $index=>$projector){
            $projector->is_booked = $projector->isBooked(Booking::where(['projector_id'=>$projector->id])->get());
            if ($projector->is_booked) {
                unset($data['available_projectors'][$index]);
            }
        }
        return view('dashboard',$data);
    }
}
