<?php
namespace App\Services\Integration\Nectar;


use Exception;

trait WsDadosDevedor
{
    private $ends;
    private $tels;
    private $emails = 1;

    public function dadosDevedor()
    {
        $this->parameters = [ "cnpjcpf" => trim($this->cnpjcpf),
            "ends" => $this->ends,
            "tels" => $this->tels,
            "emails" => $this->emails,
            "codigoParceiro" => $this->codigoParceiro,
            "codigoToken" => $this->codigoToken,
     	];

     	try{
        	$response = $this->client->GetDadosDevedor($this->parameters);
        	return $response->GetDadosDevedorResult;
     	}
     	catch(Exception $e){

     	}
    }
}