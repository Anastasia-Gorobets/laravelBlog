<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

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
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'email',
        'is_admin',
        'locale',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public const LOCALES = [
        'en'=>'English',
        'es'=>'Spain',
        'de'=>'German'
    ];

    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class);
    }

    public function image()
    {

        return $this->morphOne(Image::class,'imageable');

    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentsOn()
    {
        return $this->morphMany(Comment::class,'commentable')->latestComments();

    }

/*    public function scopeWithMostBlogPosts(Builder $query)
    {

        return $query->withCount('blogPosts')->orderBy('blog_posts_count','desc');

    }*/


    public function scopeWithMostBlogPosts(Builder $query)
    {
        //comments_count
        return $query->withCount('blogPosts')->orderBy('blog_posts_count','desc');

    }

    public function scopeWithMostBlogPostsLastMonth(Builder $query)
    {
        //comments_count
        return $query->withCount(['blogPosts'=>function($query){
            $query->whereMonth('created_at', '=', now()->subMonth()->month);
        }])
            ->has('blogPosts','>=',2)
            ->orderBy('blog_posts_count','desc');

        // ->having('blog_posts_count','>=',2)

    }

    public function scopeThatHasCommentedOnPost(Builder $query,BlogPost $blogPost)
    {
        return $query->whereHas('comments',function ($query) use ($blogPost){
            return $query->where('commentable_id', '=', $blogPost->id)->where('commentable_type', '=', BlogPost::class);
        });

    }

    public function scopeThatIsAnAdmin(Builder $query)
    {
        return $query->where('is_admin',true);
    }


}
