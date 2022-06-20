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

            <div class="container">

                <div class="row">

                    <div class="card" style="width: 100%">

                        <div class="card-body">

                            <div class="card-title">
                                Most commented
                            </div>

                            <div class="card-subtitle mb-2 text-muted">
                                <h6>What people talking about</h6>
                            </div>

                            <ul class="list-group list-group-flush">

                                @foreach($mostCommented as $post)
                                    <li class="list-group-item">

                                        <a href="{{route('posts.show',['post'=>$post->id])}}">{{$post->title}}</a>

                                    </li>


                                @endforeach



                            </ul>



                        </div>



                    </div>
                </div>

                <div class="row mt-4">

                    <div class="card" style="width: 100%">

                        <div class="card-body">

                            <div class="card-title">
                                Most active users
                            </div>

                            <div class="card-subtitle mb-2 text-muted">
                                <h6>Users with most posts written</h6>
                            </div>

                            <ul class="list-group list-group-flush">

                                @foreach($mostActiveUsers as $user)
                                    <li class="list-group-item">

                                        {{$user->name}}

                                    </li>


                                @endforeach



                            </ul>



                        </div>



                    </div>
                </div>

                <div class="row mt-4">

                    <div class="card" style="width: 100%">

                        <div class="card-body">

                            <div class="card-title">
                                Most active users in last month
                            </div>

                            <div class="card-subtitle mb-2 text-muted">
                                <h6>Users with most posts written in the last month</h6>
                            </div>

                            <ul class="list-group list-group-flush">

                                @foreach($mostActiveUsersLastMonth as $user)
                                    <li class="list-group-item">

                                        {{$user->name}}

                                    </li>


                                @endforeach



                            </ul>



                        </div>



                    </div>
                </div>




            </div>
        </div>


    </div>
@endsection
