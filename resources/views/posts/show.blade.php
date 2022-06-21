@extends('layouts.app')

@section('title',$post->title)

@section('content')

<h1>{{$post->title}}


        @badge(['show'=>now() ->diffInMinutes($post->created_at) < 30])
        New post!
        @endbadge



</h1>
<p>{{$post->content}}</p>
@updated(['date'=>$post->created_at,'name'=>$post->user->name])
@endupdated

@updated(['date'=>$post->updated_at])
Updated
@endupdated

<p>Currently read by {{$counter}} people</p>
<h4>Comments</h4>

@forelse($post->comments as $comment)
<p>{{$comment->content}}</p>
@updated(['date'=>$comment->created_at])
@endupdated



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
