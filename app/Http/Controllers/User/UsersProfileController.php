<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersProfileController extends Controller
{

    public function edit()
    {
       $user =  Auth::guard()->user();

        return view('user.profile.edit', compact('user'));

    }//End Method

    public function update(Request $request)
    {
        Auth::guard()->user()->update($request->validate([
            'name'    => 'required|string|min:5',
            'phone'   => 'required|max:30',
            'address' => 'required|string',
        ]));

        return redirect()->back()->with('success', 'User Profile Updated.');

    }//End Method

}
