@extends('layouts.app')

@section('content')


        <div class="row">

            <div class="col-4">

                @avatar(['user'=>$user]) @endavatar

            </div>

            <div class="col-8">

                <h3>{{$user->name}}</h3>

                @commentForm(['route'=>route('users.comments.store', ['user'=>$user->id])])
                @endcommentForm

                @commentsList(['comments'=>$user->commentsOn])
                @endcommentsList


            </div>

        </div>


@endsection
