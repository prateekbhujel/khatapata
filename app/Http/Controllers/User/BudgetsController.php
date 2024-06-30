<?php

namespace App\Http\Controllers\User;

use App\DataTables\BudgetDataTable;
use App\Http\Controllers\Controller;
use App\Models\Budget;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BudgetDataTable $dataTable)
    {
        return $dataTable->render('user.budget.index');

    }//End Method

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where([
            ['status', 'Active'],
            ['user_id', Auth::id()],
            ['type', 'Expense']
        ])->get();
        

        return view('user.budget.create', compact('categories'));
        
    }//End Method

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string',
            'category_id'   => 'required|exists:categories,id',
            'status'        => 'required|in:Active,Inactive',
            'amount'        => 'required|numeric|min:0', 
        ]);
        $validated['user_id'] = Auth::user()->id;

        Budget::create($validated);

        return to_route('user.budget.index')->with('success', 'Budget Created.');

    }//End Method

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budget $budget)
    {
        if(Auth::id() != $budget->user_id)
            return redirect()->back()->withErrors('Access Denined, Cannot edit Selected Budget.');
            
        $categories = Category::where([
            ['status', 'Active'],
            ['user_id', Auth::id()],
            ['type', 'Expense']
        ])->get();

        return view('user.budget.edit', compact('budget', 'categories'));

    }//End Method

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Budget $budget)
    {
        
        $validated = $request->validate([
            'name'          => 'required|string',
            'category_id'   => 'required|exists:categories,id',
            'status'        => 'required|in:Active,Inactive',
            'amount'        => 'required|numeric|min:0', 
        ]);
        $validated['user_id'] = Auth::user()->id;

      $budget->update($validated);

        return to_route('user.budget.index')->with('success', 'Budget Updated.');


    }//End Method

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budget $budget)
    {
        if (Auth::id() !== $budget->user_id) 
            return redirect()->back()->withErrors('Access denied: Cannot Delete Selected Budget.');


        $budget->delete();

        return redirect()->back()->with('success', 'Budget removed successfully.');

    }//End Method
    
}
