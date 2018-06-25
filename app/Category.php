<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Article;

class Category extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'updated_user_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the user that owns the category.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'updated_user_id');
    }

    /**
     * Get the articles for the category.
     */
    public function articles()
    {
        return $this->hasMany('App\Article', 'article_category_id');
    }
}
