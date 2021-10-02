<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>共有画面 - Youtube動画共有サイト</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Youtube動画共有サイト</h1>
        <hr>
        <form action="/movies" method="POST">
            {{ csrf_field() }}
            <div class="url">
                <h2>おすすめしたい動画のURL</h2>
                <input type="text" name="movie[url]" placeholder="動画のurl" value="{{ old('movie.url') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('movie.url') }}</p>
            </div>
            <div class="body">
                <h2>おすすめ理由</h2>
                <textarea name="movie[explanation]" placeholder="動画をおすすめする理由">{{ old('movie.explanation') }}</textarea>
                <p class="title__error" style="color:red">{{ $errors->first('movie.explanation') }}</p>
            </div>
            <div class="user_id">
                <input type="hidden" name="movie[user_id]" value="1"/>
            </div>
            <input type="submit" value="投稿"/>
        </form>
        <div class='back'>[<a href='/'>戻る</a>]</div>
    </body>
</html>