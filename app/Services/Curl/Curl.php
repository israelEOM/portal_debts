<?php
namespace App\Services\Curl;


use stdClass;
/**
*
*/
class Curl
{
	private $curl;
	private $url;
	private $response;
	private $params;
	private $headers;
	private $method;
	private $header;

	public function __construct()
	{
		$this->curl = curl_init();

		$this->response = new stdClass();
	}

	public function setUrl($url)
	{
		$this->url = $url;
	}

	public function setMethod($method)
	{
		$this->method = $method;
	}

	public function setParams($params)
	{
		$this->params = $params;
	}

	public function getResponse()
	{
		return $this->response;
	}

	public function callGet()
	{
		self::curlGet();

		self::call();

        return $this->response;
	}

	public function callGetJson()
	{
		self::call();

        $this->response->success = json_decode($this->response->success);
        $this->response->error = json_decode($this->response->error);

        return $this->response;
	}

	public function callPost()
	{
		self::curlPost();

		self::call();

		return self::getResponse();
	}

	private function curlGet()
	{
		$this->params = arrayCollect($this->params);

		if($this->params){
			$this->params = http_build_query($this->params->all());

			self::setUrl("{$this->url}/{$this->method}?{$this->params}");
		}
		else{

			self::setUrl("{$this->url}/{$this->method}");
		}
	}

	private function curlPost()
	{
		$params = [CURLOPT_POST => count($this->params),
			CURLOPT_POSTFIELDS => json_encode($this->params)
		];

		self::setOpt($params);
	}

	private function header()
	{
		$this->headers = [CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_HTTPHEADER => isset($this->header) ? $this->header : []
		];


		self::setOpt($this->headers);
	}

	public function setHeader($header)
	{
		$this->header = $header;
	}

	private function curlOptions()
	{
		$this->curlOpt = [CURLOPT_URL => $this->url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 4294967296,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_SSL_VERIFYPEER => false
		];

		self::setOpt($this->curlOpt);
	}

	private function setOpt($curlOpt)
	{
		curl_setopt_array($this->curl, $curlOpt);
	}

	private function call()
	{
		self::header();
		self::curlOptions();

		$this->response->success = curl_exec($this->curl);
		$this->response->error = curl_error($this->curl);
	}

	public function __destruct()
	{
		curl_close($this->curl);
	}
}