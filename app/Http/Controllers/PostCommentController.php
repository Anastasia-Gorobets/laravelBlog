<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Jobs\NotifyUsersPostWasCommented;
use App\Jobs\ThrottledMail;
use App\Mail\CommentPosted;
use App\Mail\CommentPostedMarkDown;
use App\Mail\CommentPostedOnPostWatched;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create','store','edit','update','destroy']);
    }

    public function store(BlogPost $post, StoreComment $request)
    {
       $comment =  $post->comments()->create([
            'user_id'=>$request->user()->id,
            'content'=>$request->input('content')
            ]);


      // $when = now()->addMinutes(1);

      // Mail::to($post->user)->queue(new CommentPostedMarkDown($comment));

       ThrottledMail::dispatch(new CommentPostedMarkDown($comment),$post->user)->onQueue('high');
       NotifyUsersPostWasCommented::dispatch($comment)->onQueue('low');

      // Mail::to($post->user)->later($when,new CommentPostedMarkDown($comment));


        return  redirect()->back()->withStatus('Comment was created');
    }

}
