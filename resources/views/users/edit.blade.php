@extends('layouts.app')

@section('content')

    <form enctype="multipart/form-data" method="POST" action="{{route('users.update',['user'=>$user->id])}}">

        @method('PUT')
        @csrf

        <div class="row">

            <div class="col-4">

                @avatar(['user'=>$user]) @endavatar

                <div class="card mt-4">

                    <div class="card-body">

                        <h6>Upload different photo</h6>
                        <input class="form-control" type="file" name="avatar">

                    </div>

                </div>



            </div>

            <div class="col-8">

                <div class="form-group">

                    <label for="title">Name:</label>
                    <input  class="form-control" type="text" name="name" value="{{$user->name}}">

                </div>

                <div class="form-group">

                    <button class="btn btn-primary" type="submit">Save changes</button>

                </div>


            </div>

            @errors @enderrors

        </div>



    </form>

@endsection
