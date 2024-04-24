<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
    */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relationship with the Category model.
     * A user can have many categories.
    */
    public function categories()
    {
        return $this->hasMany(Category::class);
        
    }//End Method

    /**
     * Relationship with the Income model.
     * A user can have many income records.
    */
    public function incomes()
    {
        return $this->hasMany(Income::class);
        
    }//End Method

    /**
     * Relationship with the Expense model.
     * A user can have many expense records.
    */
    public function expenses()
    {
        return $this->hasMany(Expense::class);
        
    }//End Method

    /**
     * Relationship with the Budget model.
     * A user can have many budgets.
    */
    public function budget()
    {
        return $this->hasMany(Budget::class);
        
    }//End Method
}
