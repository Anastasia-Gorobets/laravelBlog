<html>
<head>
    <title>My blog</title>
    <link rel="stylesheet" href="/app.css">
    <script src="/app.js"></script>
</head>

<body>

<h1>{{ __('messages.blog_header') }}</h1>

<h1>{{ __('messages.example_with_value',['name'=>'Nastya']) }}</h1>

<h1>{{trans_choice('messages.plural',0)}}</h1>
<h1>{{trans_choice('messages.plural',1)}}</h1>
<h1>{{trans_choice('messages.plural',2)}}</h1>

<p>{{__('Blog header')}}</p>
<p>{{__('Hello :name',['name'=>'Nastya2'])}}</p>


@foreach ($posts as $post)
    <?= $post ?>
@endforeach



</body>
</html>



