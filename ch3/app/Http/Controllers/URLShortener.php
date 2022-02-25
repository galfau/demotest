<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Jobs\CrawlWeb;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class URLShortener extends Controller
{
    public function shortener(Request $request)
	{
		// must be a valid url and don't exists already
		$validator = Validator::make($request->all(), [
			'url' => 'required|url|unique:urls',
		]);

		if($validator->fails()){
			return response()
				->json(['status' => false, 'errors' => $validator->errors()]);
		}

		// shortening algo
		do{
			$shorterUrl = substr(md5(uniqid(rand(), true)),0,6);
		} while(Url::where('key', $shorterUrl)->count() > 0);

		// Loop while key exist
		if( Url::where('key', $shorterUrl)->count() > 0){
			$shorterUrl = substr(md5(uniqid(rand(), true)),0,6);
		}

		// store url
		$url = new Url();
		$url->url = $request->url;
		$url->key = $shorterUrl;
		// $url->title = '';
		$url->save();

		// dispatch job to crawl and fetch title
		dispatch(new CrawlWeb($url));

		return response()
			->json(['status'=>true, 'url' => url($shorterUrl)]);

	}
}
