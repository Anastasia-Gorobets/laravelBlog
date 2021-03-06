<h3>
    @if($post->trashed())
        <del>
    @endif
    <a class="{{$post->trashed() ?" text-muted":""}}" href="{{route('posts.show', ['post'=>$post->id])}}" >{{$post->title}}</a>
    @if($post->trashed())
        </del>
    @endif
</h3>

@updated(['date'=>$post->created_at,'name'=>$post->user->name, 'userId'=>$post->user->id])
@endupdated

@tags(['tags'=>$post->tags])
@endtags

{{trans_choice('messages.comments',$post->comments_count)}}

<div class="md-3">
        @auth
            @can('update',$post)
                <a href="{{route('posts.edit', ['post'=>$post->id])}}" class="btn btn-primary">Edit</a>
            @endcan

            @if(!$post->trashed())
                @can('delete',$post)
                    <form class="d-inline" method="POST" action="{{route('posts.destroy', ['post'=>$post->id])}}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-primary" value="Delete">
                    </form>
                @endcan
             @endif
        @endauth
</div>
