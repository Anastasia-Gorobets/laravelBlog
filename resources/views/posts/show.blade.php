@extends('layouts.app')

@section('title',$post->title)

@section('content')

<h1>{{$post->title}}</h1>
<p>{{$post->content}}</p>
<p>Added {{ $post->created_at->diffForHumans() }} by {{$post->user->name}}

</p>

@if(now() ->diffInMinutes($post->created_at) < 5)
    <div class="alert alert-info">New!</div>
@endif

<h4>Comments</h4>

@forelse($post->comments as $comment)
<p>{{$comment->content}}</p>
<p class="text-muted">added {{$comment->created_at->diffForHumans()}}</p>
@empty
    <p>No comments yet</p>
@endforelse
{{--@isset($post['has_comments'])
<h1>Has comments</h1>
@endisset--}}


   {{-- @if($post['is_new'])
        <h1>New blog post</h1>
    @else
        <h1>Not new blog post</h1>
    @endif


    @unless($post['is_new'])
        <h1>Not new blog post2</h1>
    @endunless
--}}
@endsection
