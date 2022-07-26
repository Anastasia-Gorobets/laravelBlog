<?php

namespace App\Http\Controllers;
use App\Events\CommentPosted;
use App\Http\Requests\StoreComment;
use App\Models\BlogPost;

use App\Http\Resources\Comment as CommentResource;
use App\Http\Resources\CommentJustId as CommentJustId;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create','store','edit','update','destroy']);
    }

    public function index(BlogPost $post)
    {

        //return new CommentResource($post->comments()->first());
        return CommentResource::collection($post->comments()->with('user')->get());
        //return CommentJustId::collection($post->comments);
        //return $post->comments()->with('user')->get();

    }

    public function store(BlogPost $post, StoreComment $request)
    {
       $comment =  $post->comments()->create([
            'user_id'=>$request->user()->id,
            'content'=>$request->input('content')
            ]);

       event(new CommentPosted($comment));


      // $when = now()->addMinutes(1);
      // Mail::to($post->user)->queue(new CommentPostedMarkDown($comment));
      // Mail::to($post->user)->later($when,new CommentPostedMarkDown($comment));


        return  redirect()->back()->withStatus('Comment was created');
    }

}
