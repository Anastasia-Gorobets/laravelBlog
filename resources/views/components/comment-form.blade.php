<div class="mb-2 mt-2">

    @auth
        <form action="{{$route}}" method="POST">
            @csrf
            <div class="form-group">
                <textarea class="form-control" id="content" name="content" cols="30" rows="3"></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Add comment</button>
            </div>

            @errors @enderrors
        </form>

    @else
        <a href="{{route('login')}}">Sign-in</a> to posts comments
    @endauth

</div>
