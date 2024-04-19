<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}