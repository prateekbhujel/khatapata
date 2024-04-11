<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo;

    public function __construct()
    {
        $this->middleware('guest:cms')->except('logout');

        $this->redirectTo = route('admin.dashboard.index');
    }


    public function showLoginForm()
    {
        return view('admin.login.show');
    }


    protected function guard()
    {
        return Auth::guard('cms');
    }

    // protected function credentials(Request $request)
    // {
    //     return array_merge($request->only($this->username(), 'password'), ['status' => 'Active']);
    // }
}