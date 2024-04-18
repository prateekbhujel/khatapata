<?php

namespace App\Http\Controllers\User;

use App\DataTables\IncomeDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IncomeDataTable $dataTable)
    {
        return $dataTable->render('user.incomes.index');
        
    }//End Method


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('user_id', Auth::id())
                                ->where('status', 'Active')
                                ->where('type', 'income')
                                ->get();

        return view('user.incomes.create', 'categories');

    }//End Method


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

    }//End Method


    /**
     * Display the specified resource.
     */
    public function show(Income $income)
    {
        //

    }//End Method


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Income $income)
    {
        $categories = Category::where('user_id', Auth::id())
        ->where('status', 'Active')
        ->where('type', 'income')
        ->get();

        return view('user.incomes.edit', 'categories', 'income');

    }//End Method

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Income $income)
    {
        //

    }//End Method


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Income $income)
    {
        $income->delete();

    }//End Method

}
