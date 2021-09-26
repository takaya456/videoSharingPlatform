<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Website Name</h1>
        <!-- <p class='create'>[<a href='posts/create'>create</a>]</p> -->
        <hr>
        <h2>最新の動画</h2>
        <div class='movies'>
            @foreach($movies as $movie)
                <div class='movie'>
                    <p class='body'>{{ $movie->explanation }}</p>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $movies->links() }}
        </div>
    </body>
</html>