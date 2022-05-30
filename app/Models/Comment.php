<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

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
}
