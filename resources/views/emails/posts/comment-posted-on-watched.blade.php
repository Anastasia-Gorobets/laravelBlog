@component('mail::message')
    # Comment was posted on your blog post you are watching


    Hi, {{$user->name}}

    Someone has commented your blog post

    Thanks,
    {{ config('app.name') }}
@endcomponent
