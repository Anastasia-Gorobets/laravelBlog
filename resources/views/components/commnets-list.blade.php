@forelse($comments as $comment)
    <p>{{$comment->content}}</p>
    @updated(['date'=>$comment->created_at, 'name'=>$comment->user->name, 'userId'=>$comment->user->id])
    @endupdated

    @tags(['tags'=>$comment->tags])
    @endtags

@empty
    <p>No comments yet</p>
@endforelse
