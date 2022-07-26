<?php

namespace App\Models;

use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use HasFactory;

    use SoftDeletes, Taggable;

    protected $fillable = [
        'blog_post_id',
        'user_id',
        'content'
    ];

    protected $hidden = ['commentable_type','commentable_id', 'deleted_at', 'user_id'];

    /**
     * Get the blog post that owns the comment.
     */
/*    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }*/


    public function commentable()
    {
        return $this->morphTo();
    }

    public function scopeLatestComments(Builder $query)
    {
        return $query->orderBy('created_at','desc');

    }

    public function user()
    {
        return $this->belongsTo(User::class);

    }

}
