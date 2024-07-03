<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $casts = [
        'expense_receipts' => 'array',
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
     * Gets the first Item as an thumnail for image of an tranasactions,
     * In this case for Expenses.
    */
    protected function thumbnail(): Attribute
    {
        return Attribute::get(function($value, $attr) {
            return json_decode($attr['expense_receipts'], true)[0] ?? 'placeholder-image.jpg';
        });

    }//End Mehtod
}
