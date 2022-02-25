<?php

namespace App\Utils;

use Illuminate\Support\Facades\Log;

class Crawler {

	public static function GetTitle($url)
	{

		$response = self::_FetchUrl($url);
		Log::info($response['response']);
		Log::info($response['status']);

		if($response['status'] == 200){
			return self::_GetTitle($response['response']);
		}

		return '';
	}

	public static function _FetchUrl($url)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)'); // lets fake a browser
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

		$response = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		return ['response' => $response, 'status' => $httpcode];
	}

	public static function _GetTitle($html)
	{
		$dom = new \DomDocument();
		@$dom->loadHTML($html);

		$titleNode = $dom->getElementsByTagName('title');
		if (count($titleNode) > 0) {
			Log::info('HAS TITLE');
			Log::info($titleNode->item(0)->nodeValue);
			return $titleNode->item(0)->nodeValue;
		}

		return '';
	}
}