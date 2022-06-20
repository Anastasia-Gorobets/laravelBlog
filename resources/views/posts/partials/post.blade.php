{{--@break($key == 2)--}}
{{-- @continue($key == 1)--}}

<h3>
    @if($post->trashed())
        <del>
    @endif
    <a class="{{$post->trashed() ?" text-muted":""}}" href="{{route('posts.show', ['post'=>$post->id])}}" >{{$post->title}}</a>
    @if($post->trashed())
        </del>
    @endif
</h3>

<p>Added {{ $post->created_at->diffForHumans() }} by {{$post->user->name}}


@if($post->comments_count)
    <p>{{$post->comments_count}} comments</p>
@else
    <p>No comments yet!</p>
@endif

{{--@if(auth()->user()->id == $post->user_id)--}}
<div class="md-3">
    @can('update',$post)
    <a href="{{route('posts.edit', ['post'=>$post->id])}}" class="btn btn-primary">Edit</a>
    @endcan

    @cannot('delete',$post)
      <p>You cant delete this  post</p>
    @endcannot


        @if(!$post->trashed())
            @can('delete',$post)
                <form class="d-inline" method="POST" action="{{route('posts.destroy', ['post'=>$post->id])}}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-primary" value="Delete">
                </form>
            @endcan
         @endif


</div>
{{--@endif--}}

