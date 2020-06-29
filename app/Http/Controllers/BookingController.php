<?php

namespace App\Http\Controllers;

use App\Booking;
use App\User;
use App\Projector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $projectors = Projector::all();
        foreach ($projectors as $index=>$projector) {
            $projector->department;
            $projector->is_booked = $projector->isBooked(Booking::where(['projector_id'=>$projector->id])->get());
            // if ($projector->is_booked) {
            //     unset($projectors[$index]);
            // }
        }
        // $pf = array_values($projectors);
        $staff = User::where('id','!=',Auth::user()->id)->get();
        $bookings = Booking::where(['returned_to'=>'0'])->orderBy('id','desc')->get();
        foreach ($bookings as $booking) {
            $booking->approved;
            $booking->projector;
        }
        return view('projector.book',['projectors'=>$projectors,'bookings'=>$bookings,"staff"=>$staff]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validData = $request->validate([
            'user_id'=>'required',
            'projector_id'=>'required',
        ]);
        $validData['approved_by'] = Auth::user()->id;
        $booking = Booking::create($validData);

        return back()->withStatus('Projector Booked');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
        $booking->returned_to = Auth::user()->id;
        $booking->save();

        return back()->withStatus('Booking Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
