@component('mail::message')
# Comment was posted on your blog post

Hi, {{$comment->commentable->user->name}}

Someone has commented your blog post


@component('mail::button', ['url' => route('posts.show', ['post'=>$comment->commentable->id])])
View the blog post
@endcomponent


@component('mail::button', ['url' => route('users.show', ['user'=>$comment->user->id])])
 Visit {{$comment->user->name}}
@endcomponent


@component('mail::panel')
 {{$comment->content}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
