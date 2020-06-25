<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Role;
use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {


        $user = User::find($request->id);

        // return $user;
        return view('profile.edit',['user'=>$user,'roles'=>Role::orderBy('name')->get()]);
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
        $user->update([
            'role_id'=>$request->role_id,
            'email'=>$request->email,
            'name'=>$request->name,
            ]);
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
