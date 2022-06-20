@extends('layouts.app')
@section ('title','Contact page')
@section('content')

    @can('home.secret')
     <a href="{{ route('secret') }}">Special link</a>
    @endcan
    Contact
@endsection
