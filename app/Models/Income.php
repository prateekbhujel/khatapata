<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Income extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'income_receipts' => 'array',
    ];

    /**
     * Relationship with the User model.
    */
    public function user()
    {
        return $this->belongsTo(User::class);

    }//End Method

    /**
     * Relationship with the Category model.
    */
    public function category()
    {
        return $this->belongsTo(Category::class);

    }//End Method


    /** 
     * Gets the first Item as an Thumnail for Image of an Transaction
     * In this case for Incomes.
    */
    protected function thumbnail(): Attribute
    {
        return Attribute::get(function($value, $attr) {
            return json_decode($attr['income_receipts'], true)[0] ?? 'placeholder-image.jpg';
        });

    }//End Mehtod


    /**
     * Gets the total balance available from the db. 
    */
    public function totalBalance()
    {
        return $this::total('amount');

    }//End Method


        /**
     * Check if the income can be updated without causing insufficient funds.
     */
    public static function canUpdateIncome(Income $income, array $validated): bool
    {
        $incomeDate = Carbon::parse($validated['income_date']);

        // Sum total expenses up to the given income date
        $totalExpensesUpToDate = Expense::where('user_id', Auth::id())
            ->whereDate('expense_date', '>=', $incomeDate)
            ->sum('amount');

        // Sum total income up to the given income date excluding the current income
        $totalIncomeUpToDateExcludingCurrent = Income::where('user_id', Auth::id())
            ->where('id', '!=', $income->id)
            ->whereDate('income_date', '<=', $incomeDate)
            ->sum('amount');

        // Calculate the new total income
        $newTotalIncome = $totalIncomeUpToDateExcludingCurrent + $validated['amount'];

        // Ensure the new total income can cover the total expenses
        return $newTotalIncome >= $totalExpensesUpToDate;

    }//End Method

}