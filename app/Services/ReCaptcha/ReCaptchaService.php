<?php
namespace App\Services\ReCaptcha;


use App\Services\Desenv\Curl\Curl;
/**
 *
 */
class ReCaptchaService
{
	private $url = "https://www.google.com/recaptcha/api/siteverify";
	private $secret = "6LdF5-kUAAAAAFNnnSVUtYEYdXQZn2gfHImhVLND";

	public function reCaptcha($response)
	{
		$data = ['secret' => $this->secret, 'response' => $response];

		$options = ["Content-type: application/x-www-form-urlencoded"];

		$curl = new Curl();
		$curl->setUrl($this->url);
		$curl->setHeader($options);
		$curl->setParams($data);
		$response = $curl->callPost();

		return $this->validate($response);
	}

	private function validate($response)
	{
		if($response->success->success){
			return ["status" => true];
		}

		return ["status" => false];
	}
}