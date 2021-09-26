<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(Movie $movie)
	{
		return view('Home/index')->with(['movies' => $movie->getPaginateByLimit()]);
	}
}
