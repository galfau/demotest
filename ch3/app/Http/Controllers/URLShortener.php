<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Jobs\CrawlWeb;
use App\Utils\CodeGenerator;
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

		// store url to get id
		$url = new Url();
		$url->url = $request->url;
		$url->save();

		// update key with shortcode
		$url->key = CodeGenerator::getCode($url->id);
		$url->save();

		// dispatch job to crawl and fetch title
		dispatch(new CrawlWeb($url));

		return response()
			->json(['status'=>true, 'url' => url($url->key)]);

	}
}
