<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Check if Admin
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->role;
    }

    /**
     * Get the categories for the user.
     */
    public function categories()
    {
        return $this->hasMany('App\Category', 'updated_user_id');
    }

    /**
     * Get the articles for the user.
     */
    public function articles()
    {
        return $this->hasMany('App\Article', 'updated_user_id');
    }
}
