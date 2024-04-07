<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('admin.password.edit');

    }//End Method


    public function update(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required|current_password:cms',
            'password'     => 'required|confirmed|min:6',
        ], [
            'old_password.current_password' => 'The old password is incorrect.',
        ]);

        Auth::guard('cms')->user()->update($validated);

        return redirect()->back()->with('success', 'Password Changed.');

    }//End Method
}
