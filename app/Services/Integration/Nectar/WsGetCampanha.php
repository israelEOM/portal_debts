<?php
namespace App\Services\Integration\Nectar;


use Exception;
use Arr;

trait WsGetCampanha
{
    private $idProposta;

    public function setProposta($idProposta)
    {
        $this->idProposta = $idProposta;
    }

    public function getCampanha()
    {
        $this->parameters = [
            "cnpjcpf" => $this->cnpjcpf,
            "idServ" => $this->idServidor,
            "IDPRO_PRO" => $this->idProposta,
            "codigoParceiro" => $this->codigoParceiro,
            "codigoToken" => $this->codigoToken,
        ];

        try{

            $response = $this->client->GetOpcoesCampanha($this->parameters);

            return $response->GetOpcoesCampanhaResult;
        }
        catch(Exception $e){

        }
    }
}
