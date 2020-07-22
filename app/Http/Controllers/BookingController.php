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

    public function request(Request $request,$id)
    {
        $booking0 = Booking::where(['user_id'=>Auth::user()->id,'projector_id'=>$id,"approved_by"=>0])->get();
        if($booking0!=null && count($booking0)>0){
            // return json_encode($booking0);
            return back()->withError('You have already submited request for this projector');
        }
        $booking = Booking::create([
            'user_id' => Auth::user()->id,
            'projector_id'=>$id,
            'approved_by'=>0,
        ]);

        return back()->withStatus('Projector Booking request Submited');
    }

    public function requests($id)
    {
        $requests = Projector::find($id);

        if($requests==null){
            return back()->withError('Projector not found');
        }

        if(count($requests->requests)==0){
            return back()->withError('No request found for this projector');
        }

        return view("pages.requests",['data'=>$requests->requests ]);
    }

    public function approve($id)
    {
        $booking = Booking::find($id);

        if($booking==null){
            return back()->withError('Request not found');
        }
        $booking->approved_by = Auth::user()->id;
        $booking->save();

        return back()->withStatus('Request approved succesfully');
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
    public function destroy($id)
    {
        Booking::where('id',$id)->delete();
        return back()->withStatus('Request revoked');
    }


    public function reports(){
        return ['wow'=>'fuck'];
    }
}
