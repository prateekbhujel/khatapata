<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected string $redirectTo;

    public function __construct()
    {
        $this->middleware('guest:cms')->except('logout');

        $this->redirectTo = route('admin.dashboard.index');
    }


    public function showLoginForm(): View
    {
        return view('admin.login.show');
    }


    protected function guard(): object
    {
        return Auth::guard('cms');
    }

    // protected function credentials(Request $request)
    // {
    //     return array_merge($request->only($this->username(), 'password'), ['status' => 'Active']);
    // }


}
