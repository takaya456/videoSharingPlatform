<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

class MovieController extends Controller
{
	public function store(Movie $movie, Request $request)
	{
		$input = $request['movie'];
		$movie->fill($input)->save();
		return redirect('/');
	}
}
