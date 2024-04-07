<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class StaffsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdminDataTable $dataTable)
    {
        return $dataTable->render('admin.staffs.index');

    }//End Method

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.staffs.create');
        
    }//End Method

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       Admin::create($request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email|unique:admins,email',
            'password'  => 'required|confirmed',
            'phone'     => 'required|max:30|min:10',
            'address'   => 'required|string',
            'status'    => 'required|in:Active,Inactive',
        ]));

        return to_route('admin.staffs.index')->with('success', 'Staff added.');
        
    }//End Method

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $staff)
    {
        return view('admin.staffs.edit', compact('staff'));
        
    }//End Method

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $staff)
    {
        $staff->update($request->validate([
            'name'      => 'required|string',
            'phone'     => 'required|max:30|min:10',
            'address'   => 'required|string',
            'status'    => 'required|in:Active,Inactive',
        ]));

        return to_route('admin.staffs.index')->with('success', 'Staff Updated.');
        
    }//End Method

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $staff)
    {
        $staff->delete();

        return redirect()->back()->withSuccess('Staff Removed');
        
    }//End Method
}
