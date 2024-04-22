<?php

namespace App\Http\Controllers\User;

use App\DataTables\ExpenseDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ExpenseDataTable $dataTable)
    {
        if(!Income::userHasIncome())
            return back()->withErrors('Income not set. Please set your income before accessing expenses.');

        return $dataTable->render('user.expenses.index');

    }//End method

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('user_id', Auth::id())
        ->where('status', 'Active')
        ->where('type', 'expense')
        ->get();

        return view('user.expenses.create', 'categories');

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
    public function show(Expense $expense)
    {
        //

    }//End Method

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $categories = Category::where('user_id', Auth::id())
                                ->where('status', 'Active')
                                ->where('type', 'income')
                                ->get();

        return view('user.expenses.edit', 'categories', 'expense');

    }//End Method

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        //

    }//End method

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        
    }//End method
}
