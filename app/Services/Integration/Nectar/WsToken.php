<?php
namespace App\Services\Integration\Nectar;


use Exception;

trait WsToken
{
    protected $codigoParceiro = "1";
	private $cnpj = "02784022000115";
	private $usu = "admin";
	private $pass = "123";
    public $codigoToken;

    public function token()
    {
        $this->parameters = [
            "cnpj" => $this->cnpj,
			"codigoParceiro" => $this->codigoParceiro,
			"usu" => $this->usu,
			"pass" => $this->pass,
     	];

     	try{
        	$response = $this->client->GetToken($this->parameters);
        	$response = $response->GetTokenResult;

            $this->setToken($response->CodigoToken);

            return $response;
     	}
     	catch(Exception $e){
            return false;
     	}
    }

    public function verifyToken($token)
    {
        $this->parameters = ["codigoToken" => $token,
            "codigoParceiro" => $this->codigoParceiro
        ];

        try{
            $response = $this->client->VerifyToken($this->parameters);
            $response = $response->VerifyTokenResult;
        }
        catch(Exception $e){

        }
    }

    public function setToken($token)
    {
        $this->codigoToken = $token;
    }
}