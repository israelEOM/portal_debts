<?php
namespace App\Services\Integration\Nectar;


use Exception;
use Arr;
use Carbon\Carbon;

trait WsGetDivida
{
    protected $cnpjcpf;
    protected $idContrato;
    protected $idServidor;
    private $agrupamento;

    public function divida()
    {
        $this->parameters = ["cnpjcpf" => $this->cnpjcpf,
			"agrupamento" => $this->agrupamento,
			"codigoParceiro" => $this->codigoParceiro,
			"codigoToken" => $this->codigoToken,
     	];

     	try{

        	$response = $this->client->GetDadosDivida($this->parameters);

            return $response->GetDadosDividaResult;
     	}
     	catch(Exception $e){

            return false;
     	}
    }
}