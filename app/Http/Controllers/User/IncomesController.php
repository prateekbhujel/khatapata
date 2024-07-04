<?php

namespace App\Http\Controllers\User;

use App\DataTables\IncomeDataTable;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;


class IncomesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IncomeDataTable $dataTable)
    {
        return $dataTable->render('user.income.index');

    }//End Method

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::where('type', 'income')
                                ->where('status','Active')
                                ->where('user_id', auth()->user()->id)
                                ->get();

        return view('user.income.create', compact('categories'));

    }//End Method


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount'             => 'required|numeric|min:0',
            'category_id'        => 'required|exists:categories,id',
            'income_note'        => 'required|string|min:5|max:1000',
            'income_receipts'    => 'nullable|array',
            'income_receipts.*'  => 'nullable|image|mimes:jpeg,jpg,webp|max:2048',
            'income_date'        => 'required|date',
        ]) + [
            'user_id'            => Auth::id()
        ];
    
        $income_receipts = [];
        if ($request->hasFile('income_receipts')) {
            // Ensure the directory exists
            $directory = 'public/images/income_receipts';
            Storage::makeDirectory($directory);
    
            foreach($request->file('income_receipts') as $receipt) {
                $filename = "img" . date('YmdHis') . rand(1000, 9999) . "." . $receipt->extension();
                
                $img = (new Image(new Driver))->read($receipt);
                $img->resize(1280, 720, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                
                $path = storage_path("app/{$directory}/{$filename}");
                $img->save($path);
                $income_receipts[] = $filename;
            }
        }
    
        $validated['income_receipts'] = $income_receipts;
        $income = Income::create($validated);

        //Update balance
        $balance = Balance::firstOrCreate(['user_id' => Auth::id()]);
        $balance->increment('balance', $income->amount);

        return to_route('user.income.index')->with('success', 'Income Created.');

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

        return view('user.income.edit', compact('categories', 'income'));

    }//End Method

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Income $income)
    {
        $validated = $request->validate([
            'amount'             => 'required|numeric|min:0',
            'category_id'        => 'required|exists:categories,id',
            'income_note'        => 'required|string|min:5|max:1000',
            'income_receipts'    => 'nullable|array',
            'income_receipts.*'  => 'nullable|image|mimes:jpeg,jpg,webp|max:2048',
            'income_date'        => 'required|date',
        ]) + [
            'user_id'            => Auth::id()
        ];

        // Check if the updated income will cover the expenses up to the date
        if (!Income::canUpdateIncome($income, $validated)) {
            return redirect()->back()->withErrors(['amount' => 'Updating this income will cause insufficient funds for existing expenses.']);
        }

        // Adjust balance for the difference in income amounts
        $balance = Balance::where('user_id', Auth::id())->first();
        $incomeDifference = $validated['amount'] - $income->amount;

        if ($incomeDifference + $balance->balance < 0) {
            return redirect()->back()->withErrors(['amount' => 'Insufficient balance after updating the income.']);
        }

        $receipts = $income->income_receipts;
        if($request->hasFile('income_receipts'))
        {
            foreach($request->income_receipts as $receipt) {
                $filename = "img" . date('YmdHis') . rand(1000, 9999) . "." .$receipt->extension();

                $img = (new Image(new Driver))->read($receipt);

                $img->scaleDown(1280, 720)->save(storage_path("app/public/images/income_receipts/$filename"));

                $receipts[] = $filename;
            }
        }

        $validated['income_receipts'] = $receipts;
        $income->update($validated);

        //Update balance
        $balance = Balance::firstOrCreate(['user_id' => Auth::id()]);
        $balance->increment('balance', $income->amount);

        return to_route('user.income.index')->with('success', 'Income record has been updated.');

    }//End Method


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Income $income)
    {
        $balance = Balance::firstOrCreate(['user_id' => Auth::id()]);
        $balance->decrement('balance', $income->amount);

        foreach($income->income_receipts as $receipt)
        {
            unlink(storage_path("app/public/images/income_receipts/$receipt"));
        }

        $income->delete();

        return to_route('user.income.index')->with('success', 'Income record removed.');

    }//End Method

    public function receipt(Income $income, string $filename)
    {
        if(count($income->income_receipts) > 0)
        {
            unlink(storage_path("app/public/images/income_receipts/$filename"));

            $income_receipts = array_values(array_diff($income->income_receipts, [$filename]));

            $income->update(['income_receipts' => $income_receipts]);

            return response(['success' => 'Receipt Removed'], 200);

        }else
        {
            return response(['error' => 'At least one receipt is required.'], 400);
        }

    }//End Method



}