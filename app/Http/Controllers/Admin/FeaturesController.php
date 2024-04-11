<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FeatureDataTable;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FeatureDataTable $dataTable)
    {
        return $dataTable->render('admin.features.index');

    }//End Method

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.features.create');

    }//End Method

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Feature::create($request->validate([
            'name'          => 'required|string|min:5|max:30',
            'description'   => 'required|string|min:10',
            'status'        => 'required|in:Active,Inactive',
        ]));

        return to_route('admin.features.index')->with('success', 'Feature added.');

    }//End Method

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feature)
    {
        return view('admin.features.edit', compact('feature'));

    }//End Method

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        $feature->update($request->validate([
            'name'          => 'required|string|min:5|max:30',
            'description'   => 'required|string|min:10',
            'status'        => 'required|in:Active,Inactive',
        ]));

        return to_route('admin.features.index')->with('success', 'Feature Updated.');

    }//End Method

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)
    {
        $feature->delete();

        return redirect()->back()->withSuccess('Feature Removed.');

    }//End Method
}
