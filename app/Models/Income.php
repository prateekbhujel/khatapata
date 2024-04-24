<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Income extends Model
{
    use HasFactory;

    protected $guarded = [];

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
     *  Checks if the user has set an Income or not.
    */
    public static function userHasIncome()
    {
        return Income::where('user_id', Auth::id())->exists();
        
    }//End Method

    /**
     * Get the budgets associated with the income.
    */
    public function budgets()
    {
        return $this->belongsToMany(Budget::class);

    }//End Method

}