<?php

use App\Models\Url;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// first so it match first
Route::get('/top100', function(){
	$urls = Url::orderBy('visits', 'DESC')->limit(100)->get();
	return view('top100')
		->with('urls', $urls);
});

// redirect to full url
Route::get('/{tag}', function ($tag) {
	$url = Url::where('key', $tag)->first();
	if($url){
		// increase visit
		$url->visits = $url->visits + 1;
		$url->save();

		return redirect()->to($url->url);
	}

	abort(404);
});