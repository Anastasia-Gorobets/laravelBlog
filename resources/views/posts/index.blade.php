@extends('layouts.app')

@section('title','All posts')

@section('content')

    <div class="row">

        <div class="col-8">
            @forelse($posts as $key => $post)
                @include('posts.partials.post')
            @empty
                No posts
            @endforelse
        </div>

        <div class="col-4">
            @include('posts._activity')
        </div>

    </div>
@endsection
