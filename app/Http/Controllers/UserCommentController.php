<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\Request;

class UserCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create','store','edit','update','destroy']);
    }

    public function store(User $user, StoreComment $request)
    {
        $user->commentsOn()->create([
            'user_id'=>$request->user()->id,
            'content'=>$request->input('content')
        ]);
        return  redirect()->back()->withStatus('Comment was created');

    }
}
