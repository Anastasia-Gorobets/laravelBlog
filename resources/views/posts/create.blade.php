@extends('layouts.app')

@section('title','Create post')

@section('content')
    <form action="{{ route('posts.store') }}" method="POST">

        @include('posts.partials.form')
        <div class="form-group"><input class="btn btn-primary btn-block" type="submit" value="Create"></div>
    </form>
@endsection
