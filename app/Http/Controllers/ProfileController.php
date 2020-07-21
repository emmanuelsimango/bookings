<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Role;
use Illuminate\Http\Request;
use App\User;
use App\Department;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {


        $user = $request->id?User::find($request->id):Auth::user();

        // return $user;
        return view('profile.edit',['user'=>$user,'roles'=>Role::orderBy('name')->get(),'departments'=>Department::all()]);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {

        $user = User::find($request->id);
        // return $request;
        $user->update($request->all());
        // $user->isDirty();

        // return $user->name;

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        // return $request;
        if($request->old_password){
            auth()->user()->update(['password' => Hash::make($request->get('password'))]);
        }else{
            $user = User::find($request->id);
            $user->update(['password' => Hash::make($request->get('password'))]);
        }

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
