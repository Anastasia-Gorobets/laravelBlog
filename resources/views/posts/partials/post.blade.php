{{--@break($key == 2)--}}
{{-- @continue($key == 1)--}}
<h3>
    <a href="{{route('posts.show', ['post'=>$post->id])}}" >{{$post->title}}</a>
</h3>

@if($post->comments_count)
    <p>{{$post->comments_count}} comments</p>
@else
    <p>No comments yet!</p>
@endif

{{--@if(auth()->user()->id == $post->user_id)--}}
<div class="md-3">
    <a href="{{route('posts.edit', ['post'=>$post->id])}}" class="btn btn-primary">Edit</a>
    <form class="d-inline" method="POST" action="{{route('posts.destroy', ['post'=>$post->id])}}">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-primary" value="Delete">


    </form>
</div>
{{--@endif--}}

