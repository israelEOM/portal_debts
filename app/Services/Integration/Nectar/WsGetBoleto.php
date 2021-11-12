<?php
namespace App\Services\Integration\Nectar;


use Exception;
use Arr;

trait WsGetBoleto
{
	private $tipo = "TITULO";
    private $idBoleto;
    private $dtProrrogacao;
    private $tipoEnvio = 1;
    private $gerarPdf = 1;

    public function boleto()
    {
        $this->parameters = [
            "tipo" => $this->tipo,
            "idboleto" => $this->idBoleto,
			"idcon" => $this->idContrato,
            "idserv" => $this->idServidor,
            // "dtprorrogacao" => $this->dtProrrogacao,
            "tipoenvio" => $this->tipoEnvio,
            // "complementoenvio" => "",
            "gerarPdf" => $this->gerarPdf,
            // "imprimirPlanilha" => "",
            // "imprimirTermo" => "",
            // "nomeTermo" => "",
            "codigoParceiro" => $this->codigoParceiro,
            "codigoToken" => $this->codigoToken,
     	];

     	try{
        	$response = $this->client->GetBoletoAcordo($this->parameters);

        	return $response->GetBoletoAcordoResult;
     	}
     	catch(Exception $e){

            return false;
     	}
    }

    public function setTipoEnvio($tipo)
    {
        $this->tipoEnvio = $tipo;
    }

    public function setIdBoleto($idBoleto)
    {
        $this->idBoleto = $idBoleto;
    }

    public function setTpBoleto($tipo)
    {
        if($tipo == 1){
            $this->tipo = "PROPOSTA";
        }
        else if($tipo == 2){
            $this->tipo = "TITULO";
        }
        else if($tipo == 3){
            $this->tipo = "ACORDO";
        }
    }
}