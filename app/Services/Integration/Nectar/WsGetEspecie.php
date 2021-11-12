<?php
namespace App\Services\Integration\Nectar;


use Exception;
use Arr;

trait WsGetEspecie
{
    public $especiePagamento;

    public function getEspecie()
    {
        $this->parameters = [
            "idCon" => $this->idContrato,
			"idServ" => $this->idServidor,
            "codigoParceiro" => $this->codigoParceiro,
            "codigoToken" => $this->codigoToken
     	];

     	try{
        	$response = $this->client->GetOpcoesEspecie($this->parameters);

            $this->treatSpecies($response->GetOpcoesEspecieResult);

            return $response;
     	}
     	catch(Exception $e){
            // dd($e);
     	}
    }

    private function treatSpecies($response)
    {
        try{
            if($response->Resultado->Resultado->Mensagem == "Sucesso"){

                $response = $response->Especie->Especie;
                $response = is_array($response) ? $response : [$response];

                $response = Arr::first($response);

                $this->setEspeciePagamento($response->IdEspecie);
            }
            else{
                $this->setEspeciePagamento("Boleto");
            }
        }
        catch(Exception $e){
            $this->setEspeciePagamento("Boleto");
        }
    }

    private function setEspeciePagamento($especie)
    {
        $this->especiePagamento = $especie;
    }
}