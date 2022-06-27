<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\BlogPost;


class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create','store','edit','update','destroy']);
    }

    public function store(BlogPost $post, StoreComment $request)
    {
        $post->comments()->create([
            'user_id'=>$request->user()->id,
            'content'=>$request->input('content')
            ]);
        return  redirect()->back()->withStatus('Comment was created');
    }

}
