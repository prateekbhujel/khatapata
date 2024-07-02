<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'name', 'amount', 'start_date', 'end_date', 'status'];


    /**
    * Get the user that owns the budget.
    */
    public function user()
    {
        return $this->belongsTo(User::class);

    }//End Method

    /**
    * Get the category associated with the budget.
    */
    public function category()
    {
        return $this->belongsTo(Category::class);

    }//End Method

    /**
    * Get the expenses associated with the budget.
    */
    public function expenses()
    {
        return $this->belongsToMany(Expense::class);

    }//End Method


}

