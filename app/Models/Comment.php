<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'blog_post_id',
        'content'
    ];

    /**
     * Get the blog post that owns the comment.
     */
    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }


    public function scopeLatestComments(Builder $query)
    {
        return $query->orderBy('created_at','desc');

    }

    public function user()
    {
        return $this->belongsTo(User::class);

    }


    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

/*        static::addGlobalScope(new LatestScope);*/
    }
}
