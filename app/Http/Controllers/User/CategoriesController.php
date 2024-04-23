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
        return $dataTable->with(['model' => new Category()])->render('user.categories.index');

    }//End Method

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.categories.create');

    }//End Method

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|min:5|string|max:100',
            'type'          => 'required|in:Expense,Income',
            'status'        => 'required|in:Active,Inactive',
        ]);
        $validated['user_id'] = Auth::user()->id;

        Category::create($validated);

        return to_route('user.categories.index')->with('success', 'Categories Created.');

    }//End Method

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Check if the current user is the owner of the category
        if (Auth::id() !== $category->user_id) 
        {
            // If not the owner, redirect back with an error message
            return redirect()->back()->withErrors('You are not authorized to edit this category.');
        }
    
        // If the current user is the owner, proceed to show the edit view
        return view('user.categories.edit', compact('category'));
    }
    

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

        $category->update($validated);
        
        return to_route('user.categories.index')->with('success', 'Categories Updated.');

    }//End Method

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Check if the current user is the owner of the category
        if (Auth::id() !== $category->user_id) 
        {
            // If not the owner, redirect back with an error message
            return redirect()->back()->withErrors('Access denied: You are not authorized to delete this category.');
        }

        // If the current user is the owner, proceed to delete the category
        $category->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Category removed successfully.');
        
    }//End Method
}
