<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_YouTube;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    //index.blade.phpを表示するメソッド
    public function index(Movie $movie, Request $request)
	{
	    //データベースのmoviesテーブルから、動画のデータを全部(5個まで)取得する
	    $movies_data = $movie->get()->sortByDesc('updated_at');
	    
	    //movies_dataから、動画urlだけ取り出した配列を作成する
	    $movies_url = array();
	    foreach($movies_data as $movie_data){
	        array_push($movies_url, $movie_data->url);
	    }
	    
	    //動画url, タイトル名, 画像urlの３つの文字列が含まれた二次元配列movies_all_dataを作成する
	    $homeController = new HomeController;
	    $movies_all_data = array();
	    foreach($movies_url as $movie_url){
	        array_push($movies_all_data, $homeController->getMovieData($movie_url));
	    }
        
        //１ページに表示する数
        $num_display_limit = 100000000000;
        
        //ペジネート
        $paginator = new LengthAwarePaginator($movies_all_data, count($movies_all_data), $num_display_limit, 1, array('path' => $request->url()));
	    
	    //二次元配列を, indexに送って表示
        return view('Home/index')->with(['paginated_movies' => $paginator]);
	} 
	
	//youtubeAPIを用いて, urlに対応した動画の情報を取得して返すメソッド
	private function getMovieData(string $movie_url){
	    $homeController = new HomeController;
	    //動画のIDを抽出
	    $movie_id = $homeController->getMovieID($movie_url);
	    
	    $api_key = env('GOOGLE_API_KEY');
	    
	    $get_api_url = "https://www.googleapis.com/youtube/v3/videos?id=$movie_id&key=$api_key&part=snippet,contentDetails,statistics,status";
        $json = file_get_contents($get_api_url);
        $getData = json_decode( $json , true);
        foreach((array)$getData['items'] as $key => $gDat){
        	$video_title = $gDat['snippet']['title'];
        	$thumnail_url = $gDat['snippet']['thumbnails']['medium']['url'];
        }
	    
        //動画url, タイトル名, サムネイル画像urlを含んだ配列を作成する
        $movie_data = array();
        $movie_data = array($movie_id, $video_title, $thumnail_url);
        
        return $movie_data;
	}
	
	//youtubeのurlから、動画IDを取得する
	private function getMovieID(string $youtube_url){
        if(strstr($youtube_url, 'youtube.com')){
          $youtube_id = preg_replace('/.*v=([\d\w]+).*/', '$1', $youtube_url);
        }elseif(strstr($youtube_url, 'youtu.be')){
          $youtube_id = preg_replace('/.*\.be\/([\d\w]+).*/', '$1', $youtube_url);
        }
        return $youtube_id;
	}
	
	//create.blade.phpを表示する
	public function create(){
	    return view('create');
	}
}
