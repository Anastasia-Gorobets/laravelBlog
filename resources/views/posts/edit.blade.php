@extends('layouts.app')

@section('title','Edit post')

@section('content')
    <form action="{{ route('posts.update', ['post'=> $post->id]) }}" method="POST">
        @method('PUT')
        @include('posts.partials.form')
        <div><input class="btn btn-primary btn-block" type="submit" value="Update"></div>
    </form>
@endsection
