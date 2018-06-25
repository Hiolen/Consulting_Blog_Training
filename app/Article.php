<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'contents',
        'image_path',
        'article_category_id',
        'updated_user_id',
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
     * Get the user article_category owns the user.
     */
    public function category()
    {
        return $this->belongsTo('App\Category', 'article_category_id');
    }
}
