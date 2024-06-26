<?php

namespace App\Http\Controllers\User;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->with(['model' => new Category()])->render('user.category.index');

    }//End Method

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.category.create');

    }//End Method

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::create($request->validate([
            'name'          => 'required|min:5|string|max:100',
            'type'          => 'required|in:Expense,Income',
            'status'        => 'required|in:Active,Inactive',
        ])+ ['user_id'       => Auth::id()]);

        return to_route('user.category.index')->with('success', 'Category Created.');

    }//End Method

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        if (Auth::id() !== $category->user_id) 
            return redirect()->back()->withErrors('Access Denined, Cannot edit Selected Category');
        

        return view('user.category.edit', compact('category'));
        
    }//End Method
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {   
        $validated = $request->validate([
            'name'          => 'required|min:5|string|max:100',
            'type'          => 'required|in:Expense,Income',
            'status'        => 'required|in:Active,Inactive'
        ]);
        
        $validated['user_id'] = $category->user_id;

        // Check if the category is being used in other tables
        $inUseInBudgets = $category->budgets()->where('user_id', Auth::id())->exists();
        $inUseInIncomes = $category->incomes()->where('user_id', Auth::id())->exists();
        $inUseInExpenses = $category->expenses()->where('user_id', Auth::id())->exists();

        if ($category->status == 'Active' && ($inUseInBudgets || $inUseInIncomes || $inUseInExpenses)) {
            if($request->status == 'Inactive')
                return redirect()->back()->withErrors('You cannot set Inactive status for an  Active category.');
        }

        $category->update($validated);
        
        return to_route('user.category.index')->with('success', 'Category Updated.');

    }//End Method

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (Auth::id() !== $category->user_id) {
            return redirect()->back()->withErrors('Access denied: You are not authorized to delete this category.');
        }

        // Check if the category is being used in other tables
        $inUseInBudgets = $category->budgets()->where('user_id', Auth::id())->exists();
        $inUseInIncomes = $category->incomes()->where('user_id', Auth::id())->exists();
        $inUseInExpenses = $category->expenses()->where('user_id', Auth::id())->exists();

        if ($inUseInBudgets || $inUseInIncomes || $inUseInExpenses) {
            return redirect()->back()->withErrors('Cannot delete this category as it is being used in other records.');
        }

        $category->delete();

        return redirect()->back()->with('success', 'Category removed successfully.');

    }//End Method

}
