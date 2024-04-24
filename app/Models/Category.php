<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable =  ['name', 'status', 'type', 'user_id', 'created_at', 'updated_at'];

    
    /** 
     * Relation ship between Category Model to User Model 
    */
    public function user()
    {
        return $this->belongsTo(User::class);
        
    }//End Method

    /**
     * Get the expenses associated with the user.
    */
    public function expenses()
    {
        return $this->hasMany(Expense::class);
        
    }//End Method


    /**
     * Get the incomes associated with the user.
    */
    public function incomes()
    {
        return $this->hasMany(Income::class);

    }//End Method


    /**
     * Get the budgets associated with the user.
    */
    public function budgets()
    {
        return $this->hasMany(Budget::class);

    }//End Method

}
