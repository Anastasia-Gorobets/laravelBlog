<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create','store','edit','update','destroy']);
    }

    public function store(BlogPost $post, StoreComment $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $post->comments()->create($validated);
        $request->session()->flash('status','Comment was created');
        return  redirect()->back();

    }

}
