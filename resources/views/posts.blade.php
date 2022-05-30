<html>
<head>
    <title>My blog</title>
    <link rel="stylesheet" href="/app.css">
    <script src="/app.js"></script>
</head>

<body>

<h1>Blog header</h1>



@foreach ($posts as $post)
    <?= $post ?>
@endforeach



</body>
</html>



