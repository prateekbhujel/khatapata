<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $guarded = [];


    /**
     * Account Belongs to User.
     * An User can have many accounts. 
    */
    public function user()
    {
        $this->belongsTo(User::class);
        
    }//End Method
}
