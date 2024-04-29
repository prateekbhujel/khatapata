<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $gaurded = [];

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
     * Relationship with the Account model.
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
        
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

}