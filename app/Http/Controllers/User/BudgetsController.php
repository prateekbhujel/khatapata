<?php

namespace App\Http\Controllers\User;

use App\DataTables\BudgetDataTable;
use App\Http\Controllers\Controller;
use App\Models\Budget;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BudgetDataTable $dataTable)
    {
        return $dataTable->render('user.budgets.index');

    }//End Method

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where([
            ['status', 'Active'],
            ['user_id', Auth::id()]
        ])->get();
        

        return view('user.budgets.create', compact('categories'));
        
    }//End Method

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string',
            'category_id'   => 'required|exists:categories,id',
            'type'          => 'required|in:Expense,Income',
            'status'        => 'required|in:Active,Inactive',
            'amount'        => 'required|numeric|min:0', 
        ]);
        $validated['user_id'] = Auth::user()->id;

        Budget::create($validated);

        return to_route('user.budgets.index')->with('success', 'Budget Created.');

    }//End Method

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /** 
     * fetches the category in corespond to type:(Income, Expense)
    */
    public function fetchCategories(Request $request)
    {
        $type = $request->get('type');
        $categories = Category::where('type', $type)
                               ->where('user_id', Auth::id())
                               ->pluck('name', 'id')
                               ->toArray();
    
        if (empty($categories)) {
            return response()->json([
                'status' => 0
            ]);
        }
    
        return response()->json([
            'status' => 1,
            'categories' => $categories
        ]);
    }//End Method
}
