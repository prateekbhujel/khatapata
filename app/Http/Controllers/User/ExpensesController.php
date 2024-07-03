<?php

namespace App\Http\Controllers\User;

use App\DataTables\ExpenseDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;


class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ExpenseDataTable $dataTable)
    {
        return $dataTable->render('user.expense.index');

    }//End method

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('type', 'expense')->where('status','Active')->get();

        return view('user.expense.create', compact('categories'));

    }//End Method

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount'             => 'required|numeric|min:0',
            'category_id'        => 'required|exists:categories,id',
            'expense_note'        => 'required|string|min:5|max:1000',
            'expense_receipts'    => 'nullable|array',
            'expense_receipts.*'  => 'nullable|image|mimes:jpeg,jpg,webp|max:2048',
            'expense_date'        => 'required|date',
        ]) + [
            'user_id'            => Auth::id()
        ];
    
        $expense_receipts = [];
        if ($request->hasFile('expense_receipts')) {
            // Ensure the directory exists
            $directory = 'public/images/expense_receipts';
            Storage::makeDirectory($directory);
    
            foreach($request->file('expense_receipts') as $receipt) {
                $filename = "img" . date('YmdHis') . rand(1000, 9999) . "." . $receipt->extension();
                
                $img = (new Image(new Driver))->read($receipt);
                $img->resize(1280, 720, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                
                $path = storage_path("app/{$directory}/{$filename}");
                $img->save($path);
                $expense_receipts[] = $filename;
            }
        }
    
        $validated['expense_receipts'] = $expense_receipts;
        Expense::create($validated);
        
        return to_route('user.expense.index')->with('success', 'Expense record Created.');

    }//End Method

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $categories = Category::where('user_id', Auth::id())
        ->where('status', 'Active')
        ->where('type', 'expense')
        ->get();

        return view('user.expense.edit', compact('categories', 'expense'));

    }//End Method

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'amount'             => 'required|numeric|min:0',
            'category_id'        => 'required|exists:categories,id',
            'expense_note'        => 'required|string|min:5|max:1000',
            'expense_receipts'    => 'nullable|array',
            'expense_receipts.*'  => 'nullable|image|mimes:jpeg,jpg,webp|max:2048',
            'expense_date'        => 'required|date',
        ]) + [
            'user_id'            => Auth::id()
        ];

        $receipts = $expense->expense_receipts;
        if($request->hasFile('expense_receipts'))
        {
            foreach($request->expense_receipts as $receipt) {
                $filename = "img" . date('YmdHis') . rand(1000, 9999) . "." .$receipt->extension();

                $img = (new Image(new Driver))->read($receipt);

                $img->scaleDown(1280, 720)->save(storage_path("app/public/images/expense_receipts/$filename"));

                $receipts[] = $filename;
            }
        }

        $validated['expense_receipts'] = $receipts;
        $expense->update($validated);

        return to_route('user.expense.index')->with('success', 'Expense record has been updated.');


    }//End method

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        foreach($expense->expense_receipts as $receipt)
        {
            unlink(storage_path("app/public/images/expense_receipts/$receipt"));
        }

        $expense->delete();

        return to_route('user.expense.index')->with('success', 'Expense record removed.');

        
    }//End method

    public function receipt(Expense $expense, string $filename)
    {
        if(count($expense->expense_receipts) > 0)
        {
            unlink(storage_path("app/public/images/expense_receipts/$filename"));

            $expense_receipts = array_values(array_diff($expense->expense_receipts, [$filename]));

            $expense->update(['expense_receipts' => $expense_receipts]);

            return response(['success' => 'Receipt Removed'], 200);

        }else
        {
            return response(['error' => 'At least one receipt is required.'], 400);
        }

    }//End Method

}
