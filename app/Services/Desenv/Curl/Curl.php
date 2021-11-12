<?php
namespace App\Services\Desenv\Curl;


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
	private $options;
	private $method;
	private $headers = [];

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

	public function setHeader($header)
	{
		$this->headers = $header;
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

		return self::getResponse();
	}

	public function callPost()
	{
		$this->optionPost();

		self::call();

		return self::getResponse();
	}

	private function curlGet()
	{
		$this->params = arrayCollect($this->params);

		$this->params = http_build_query($this->params->all());

		self::setUrl("{$this->url}{$this->method}?{$this->params}");
	}

	private function optionPost()
	{
		$this->options[CURLOPT_POST] = count($this->params);
		$this->options[CURLOPT_POSTFIELDS] = http_build_query($this->params);
	}

	private function optionHeader()
	{
		$this->options[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1;
		$this->options[CURLOPT_HTTPHEADER] = $this->headers;
	}

	private function curlOptions()
	{
		$this->options[CURLOPT_URL] = $this->url;
		$this->options[CURLOPT_RETURNTRANSFER] = true;
		$this->options[CURLOPT_ENCODING] = '';
		$this->options[CURLOPT_MAXREDIRS] = 10;
		$this->options[CURLOPT_TIMEOUT] = 120;
		$this->options[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1;
		$this->options[CURLOPT_SSL_VERIFYHOST] = false;
		$this->options[CURLOPT_SSL_VERIFYPEER] = false;

		curl_setopt_array($this->curl, $this->options);
	}

	private function call()
	{
		$this->optionHeader();

		$this->curlOptions();

		$this->response->success = json_decode(curl_exec($this->curl));
		$this->response->error = json_decode(curl_error($this->curl));
	}

	public function __destruct()
	{
		curl_close($this->curl);
	}
}