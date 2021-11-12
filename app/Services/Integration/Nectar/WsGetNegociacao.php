<?php
namespace App\Services\Integration\Nectar;


use Exception;
use Arr;

trait WsGetNegociacao
{
    private $titulo;
    private $dtVencimento;
    private $tpNegociacao;

    public function setTitulo($titulo)
    {

        $this->titulo = "";
        foreach ($titulo as $key => $value) {

            $this->titulo .= "{$value->idTitulo},";
        }

        $this->titulo = substr($this->titulo, 0, -1);
    }

    public function setTpNegociacao($tpNegociacao)
    {
        $this->tpNegociacao = $tpNegociacao;
    }

    public function setDtVencimento($dtVencimento)
    {
        $this->dtVencimento = $dtVencimento;
    }

    public function getNegociacao()
    {
        $this->parameters = [
            "idCon" => $this->idContrato,
            "idServ" => $this->idServidor,
            "titulos" => $this->titulo,
            "parcelasNum" => "1",
            "vencPrimParcela" => $this->dtVencimento,
            "tiponegociacao" => $this->tpNegociacao,
            "tpDesconto" => "1",
            "percDescAplicNoPrincipal" => $this->pcDsPrincipal,
            "percDescAplicNaCorrecao" => $this->pcDsCorrecao,
            "percDescAplicNosHonorarios" => "",
            "percDescAplicNaPontualidade" => "",
            "percDescAplicNaMulta" => "",
            "percDescAplicNoJuros" => "",
            "valorAplicNoJuros" => "",
            "valorEntradaSugerido" => "",
            "valordemais" => "",
            "valorTotalSugerido" => "",
            "codigoParceiro" => $this->codigoParceiro,
            "codigoToken" => $this->codigoToken,
        ];

        try{

            $response = $this->client->GetOpcoesNegociacao($this->parameters);

            return $response->GetOpcoesNegociacaoResult;
        }
        catch(Exception $e){

            return false;
        }
    }
}
