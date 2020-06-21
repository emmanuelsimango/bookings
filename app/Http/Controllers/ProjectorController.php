<?php

namespace App\Http\Controllers;

use App\Department;
use App\Projector;
use Illuminate\Http\Request;

class ProjectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $projectors = Projector::orderBy('id','DESC')->paginate(10);
        // return view('pages.projector',['projectors'=>$projectors]);
        return view('pages.projectors',['projectors'=>$projectors]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('projector.create',['departments'=>Department::orderBy('name')->get()]);
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
        $valid = $request->validate([
            'name'=>'required',
            'serial'=>['required','unique:projectors'],
            'booking_duration'=>'required',
            'department_id'=>'required'
        ]);


        $projector = Projector::create($request->all());


        return redirect('projector')->with('success','Projector added successifully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Projector  $projector
     * @return \Illuminate\Http\Response
     */
    public function show(Projector $projector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Projector  $projector
     * @return \Illuminate\Http\Response
     */
    public function edit(Projector $projector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Projector  $projector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Projector $projector)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Projector  $projector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projector $projector)
    {
        //
    }
}
