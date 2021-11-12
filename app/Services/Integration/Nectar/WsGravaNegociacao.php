<?php
namespace App\Services\Integration\Nectar;


use Exception;
use Arr;

trait WsGravaNegociacao
{
    private $plano;
    private $codigoFaixa;
    private $descricaoFaixa;
    private $vlOriginal;
    private $vlCorrigido;
    private $vlNegociar;
    private $vlEntrada;
    private $vlDemais;
    private $qtParcela;
    private $pcDsPrincipal;
    private $pcDsCorrecao;

    public function gravaNegociacao($dataSet = null)
    {
        $this->parameters = ["idCon" => $this->idContrato,
            "idServ" => $this->idServidor,
            "titulos" => $this->titulo,
            "plano" => $this->plano,
            "codigoFaixa" => $this->codigoFaixa,
            "descricaoFaixa" => $this->descricaoFaixa,
            "parcelasNum" => $this->qtParcela,
            "valordesconto" => "0",
            "vencimentoprimeira" => $this->dtVencimento,
            "valorprimeira" => $this->vlEntrada,
            "valororiginal" => $this->vlOriginal,
            "valorcorrigido" => $this->vlCorrigido,
            "valornegociar" => $this->vlNegociar,
            "valordemais" => $this->vlDemais,
            "prazomaximo" => "",
            "tiponegociacao" => $this->tpNegociacao,
            "boletodisponivel" => "1",
            "tpDesconto" => "1",
            "percDescAplicNoPrincipal" => "",
            "percDescAplicNaCorrecao" => "",
            // "percDescAplicNaCorrecao" => $this->pcDsPrincipal,
            // "percDescAplicNaCorrecao" => $this->pcDsCorrecao,
            "percDescAplicNosHonorarios" => "",
            "percDescAplicNaPontualidade" => "",
            "percDescAplicNaMulta" => "",
            "percDescAplicNoJuros" => "",
            "valorAplicNoJuros" => "",
            "valorEntradaSugerido" => "",
            "valorTotalSugerido" => "",
            "codigoNegociacao" => "",
            "infoNegociacao" => "",
            "especiePagamento" => $this->especiePagamento,
            "codigoParceiro" => $this->codigoParceiro,
            "codigoToken" => $this->codigoToken,
        ];


        try{
            $response = $this->client->GravarNegociacao($this->parameters);

            return $response->GravarNegociacaoResult;
        }
        catch(Exception $e){

            return false;
        }
    }

    public function setPlano($plano)
    {
        $this->plano = $plano;
    }

    public function setCodigoFaixa($codigoFaixa)
    {
        $this->codigoFaixa = $codigoFaixa;
    }

    public function setDescricaoFaixa($descricaoFaixa)
    {
        $this->descricaoFaixa = $descricaoFaixa;
    }

    public function setQtParcela($qtParcela)
    {
        $this->qtParcela = $qtParcela;
    }

    public function setVlOriginal($vlOriginal)
    {
        $this->vlOriginal = $vlOriginal;
    }

    public function setVlCorrigido($vlCorrigido)
    {
        $this->vlCorrigido = $vlCorrigido;
    }

    public function setVlNegociar($vlNegociar)
    {
        $this->vlNegociar = $vlNegociar;
    }

    public function setVlEntrada($vlEntrada)
    {
        $this->vlEntrada = $vlEntrada;
    }

    public function setVlDemais($vlDemais)
    {
        $this->vlDemais = $vlDemais;
    }

    public function setDsPrincipal($value)
    {
        $this->pcDsPrincipal = intval($value);
    }

    public function setDsCorrecao($value)
    {
        $this->pcDsCorrecao = intval($value);
    }
}