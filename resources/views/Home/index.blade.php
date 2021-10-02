<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Youtube動画共有サイト</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Youtube動画共有サイト</h1>
         <p class='create'>[<a href='movies/create'>投稿</a>]</p> 
        <hr>
        <h2>最近共有された動画</h2>
        <div class='movies'>
            @foreach($paginated_movies as $movie_all_data)
                <div class='movie'>
                    <a href="https://www.youtube.com/watch?v={{ $movie_all_data[0] }}"><img src={{ $movie_all_data[2] }}></a>
                    <a href="https://www.youtube.com/watch?v={{ $movie_all_data[0] }}"><p class='title'>{{ $movie_all_data[1] }}</p></a>
                </div>
            @endforeach
        </div>
        <div class='$paginated_movies'>
            {{ $paginated_movies->links() }}
        </div>
    </body>
</html>