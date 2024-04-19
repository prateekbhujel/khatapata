<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
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
     * Method to activate a plan and deactivate other active plans for the user.
    */
    public function activate()
    {
        // Deactivate other plans for the user
        Plan::where('user_id', $this->user_id)
            ->where('id', '!=', $this->id)
            ->update(['status' => 'Inactive']);

        // Activate the current plan
        $this->status = 'Active';
        $this->save();

    }//End Method

}
