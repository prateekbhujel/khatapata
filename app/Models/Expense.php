<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    
    protected $gaurded = [];

    protected $casts = [
        'receipts' => 'array',
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
     * Gets the first Item as an Thumnail for Image of an product.
    */
    protected function thumbnail(): Attribute
    {
        return Attribute::get(function($value, $attr) {
            return json_decode($attr['receipts'], true)[0];
        });

    }//End Mehtod

    /**
    * Get the budgets associated with the expense.
    */
    public function budgets()
    {
        return $this->belongsToMany(Budget::class);
        
    }//End Method

}
