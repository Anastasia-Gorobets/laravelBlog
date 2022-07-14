<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Mail\CommentPosted;
use App\Mail\CommentPostedMarkDown;
use App\Models\BlogPost;
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



       Mail::to($post->user)->send(new CommentPostedMarkDown($comment));


        return  redirect()->back()->withStatus('Comment was created');
    }

}
