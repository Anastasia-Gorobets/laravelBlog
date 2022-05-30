@extends('layouts.app')

@section('title','All posts')

@section('content')
   {{-- @if(count($posts))
    @foreach($posts as $post)
    <h1>{{$post['title']}}</h1>
    @endforeach
    @else
        No posts
    @endif--}}


  {{-- @each('posts.partials.post', $posts, 'post')--}}

   @forelse($posts as $key => $post)
       @include('posts.partials.post')
    @empty
        No posts
    @endforelse

 {{--   @php $test = 'Test text' @endphp
    <h1>{{$test}}</h1>--}}
@endsection
