<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index');
        
    }//End Method

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
        
    }//End Method

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create($request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|confirmed',
            'phone'     => 'required|max:30|min:10',
            'address'   => 'required|string',
            'status'    => 'required|in:Active,Inactive',
        ]));

        return to_route('admin.users.index')->with('success', 'User added.');
        
    }//End Method

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));

    }//End Method

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->validate([
            'name'      => 'required|string',
            'phone'     => 'required|max:30|min:10',
            'address'   => 'required|string',
            'status'    => 'required|in:Active,Inactive',
        ]));

        return to_route('admin.users.index')->with('success', 'User Updated.');

    }//End Method

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->withSuccess('User Removed.');

    }//End Method
}
