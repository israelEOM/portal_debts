<?php
namespace App\Services\Integration\Nectar;


use Exception;

trait WsAndamento
{
    private $idAndamento;
    private $dtAndamento;
    private $complemento;

    public function setIdAndamento($idAndamento)
    {
        $this->idAndamento = $idAndamento;
    }

    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    public function andamento()
    {
        $this->parameters = [
			"IDCON" => $this->idContrato,
            "IDSERV" => $this->idServidor,
            // "cpf" => trim($this->cnpjcpf),
            "codigoandamento" => $this->idAndamento,
            "dataandamento" => get_date(),
            "complemento" => $this->complemento,
            "codigoParceiro" => $this->codigoParceiro,
            "codigoToken" => $this->codigoToken,
     	];

     	try{
        	$response = $this->client->InsereAndamento($this->parameters);
        	$response = $response->InsereAndamentoResult;
     	}
     	catch(Exception $e){

     	}
    }
}