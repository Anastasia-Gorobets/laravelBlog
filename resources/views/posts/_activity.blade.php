<div class="container">

    <div class="row">
        @card
        @slot('title', 'Most commented')
        @slot('subtitle', 'What people talking about')

        @slot('items')
            @foreach($mostCommented as $post)
                <li class="list-group-item">
                    <a href="{{route('posts.show',['post'=>$post->id])}}">{{$post->title}}</a>
                </li>
            @endforeach
        @endslot
        @endcard
    </div>

    <div class="row mt-4">
        @card
        @slot('title', 'Most active users')
        @slot('subtitle', 'Users with most posts written')
        @slot('items', collect($mostActiveUsers)->pluck('name'))
        @endcard
    </div>

    <div class="row mt-4">
        @card
        @slot('title', 'Most active users in last month')
        @slot('subtitle', 'Users with most posts written in the last month')
        @slot('items', collect($mostActiveUsersLastMonth)->pluck('name'))
        @endcard
    </div>

</div>
