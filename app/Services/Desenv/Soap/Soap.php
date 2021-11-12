<?php
namespace App\Services\Desenv\Soap;


use SoapClient;

/**
*
*/
class Soap
{
	private $client;
	private $location;
	private $metodo;

	private function __construct($wsdl, $url)
	{
		$this->client = new SoapClient($wsdl, [
			'location' => $location,
			'uri' => $url,
			'trace'    => 1
		]);
	}

	public function setWsdl($value)
	{
		$this->wsdl = $value;
	}

	public function setLocation($value)
	{
		$this->location = $value;
	}

	public function setUrl($value)
	{
		$this->url = $value;
	}

	public function setMetodo($value)
	{
		$this->metodo = $value;
	}

	public function request($xml)
	{
		try {
			return $this->client->__doRequest($xml, $this->location, $this->metodo, 1);
		} catch (Exception $e) {
			return $e;
		}
	}
}