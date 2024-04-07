<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
       $user =  Auth::guard('cms')->user();

        return view('admin.profile.edit', compact('user'));

    }//End Method

    public function update(Request $request)
    {
        Auth::guard('cms')->user()->update($request->validate([
            'name'    => 'required|string|min:5',
            'phone'   => 'required|max:30',
            'address' => 'required|string',
        ]));

        return redirect()->back()->with('success', 'Profile Updated.');

    }//End Method
}
