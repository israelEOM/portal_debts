<?php
namespace App\Services\Ws\Traits;

use App\Repositories\Empresa\EmpresaRepository;
use Exception;
use Arr;
use stdClass;

trait Negociacao
{
    private $negociacoes;

    public function negociacao($nectar)
    {
        if($this->validadeNegotiation($nectar->Resultado)){

            $this->treatNegotiation($nectar->OpcoesNegociacao->OpcoesNegociacao);

            if(!isset($this->contrato->negociacao)){

                $this->response->stFinalizador = true;
                $this->response->status = false;
                $this->response->msg = "Sem negociações disponíveis no momento";
            }
        }

        $this->response->acesso = $this->acesso->getRepository();
    }

    private function validadeNegotiation($resultado)
    {
        if(intval($resultado->CodigoMensagem) == 17)
            return true;

        $this->response->stFinalizador = false;
        $this->response->status = false;
        $this->response->msg = "Ocorreu uma falha na comunicação. Tente novamente";

        // $this->acesso->storeResponse($resultado->Mensagem, 2, $this->contrato->empresa->id);

        return false;
    }

    private function treatNegotiation($negociacoes)
    {
        if(empty($negociacoes))
            return false;

        $this->negociacoes = collect();

        $this->contrato->negociacao = new stdClass();
        $this->contrato->negociacao->parcelas = collect();

        $this->captureTrading($negociacoes);
    }

    private function captureTrading($negociacoes)
    {
        $negociacoes = is_array($negociacoes) ? $negociacoes : [$negociacoes];

        try
        {
            foreach ($negociacoes as $value) {

                $value->DescricaoFaixa = trim($value->DescricaoFaixa);

                // if(strpos(strtoupper($value->DescricaoFaixa), "PORTAL")){

                    return $this->treatPlots($value);
                // }
            }

        }
        catch(Exception  $e)
        {
            dd($negociacoes, $e);
        }
    }

    private function treatPlots($negociacao)
    {
        // dd($negociacao);
        $parcelas = is_array($negociacao->Parcelas->Parcelas) ? $negociacao->Parcelas->Parcelas : [$negociacao->Parcelas->Parcelas];

        foreach ($parcelas as $parcela) {

            $parcela->faixa = $negociacao->DescricaoFaixa;
            $parcela->codigo = trim($negociacao->CodigoFaixa);
            $parcela->plano = trim($negociacao->Plano);
            $parcela->descontoPrincipal = $negociacao->PercentualMaximoDeDescontoNoPrincipal;
            $parcela->descontoCorrecao = $negociacao->PercentualMaximoDeDescontoNoJuros;
            $parcela->vlDesconto = $parcela->ValorDescontoNaCorrecaoParcela + $parcela->ValorDescontoNoPrincipalParcela;
            $parcela->vlOriginal = $negociacao->ValorOriginal;
            $parcela->vlCorrigido = $negociacao->ValorCorrigido;
            $parcela->vlNegociar = $negociacao->ValorNegociar;
            $parcela->vlAcordo = $parcela->ValorTotalAcordo;
            $parcela->vlEntrada = $parcela->ValorEntrada;
            $parcela->vlDemais = 0;
            $parcela->qtParcela = $parcela->Numero;
            $parcela->dtVencimento = $parcela->DataVencimento;
            $parcela->tpNegociacao = 1;

            unset($parcela->ValorTotalAcordo, $parcela->ValorEntrada, $parcela->PercentualDescontoParcela,
                $parcela->TaxaNegociacao, $parcela->DataVencimento, $parcela->ValorDescontoNaCorrecaoParcela,
                $parcela->ValorDescontoNoPrincipalParcela
            );

            if(strtoupper(trim($parcela->Numero)) == 'A VISTA'){
                unset($parcela->Numero);

                $parcela->vlResiduo = (3 * $parcela->vlEntrada) / 100;
                $parcela->valor =  ($parcela->vlEntrada - $parcela->vlResiduo);

                $parcela->vlResiduo =  number_format($parcela->vlResiduo, 2, '.', '');
                $parcela->valor =  number_format($parcela->valor, 2, '.', '');

                $this->contrato->negociacao->aVista = $parcela;
            }
            else{
                $parcela->vlDemais = $parcela->ValorDemaisParcelas;
                unset($parcela->Numero, $parcela->ValorDemaisParcelas);

                $this->contrato->negociacao->parcelas->put($parcela->qtParcela, $parcela);
            }
        }
    }

    private function calculaDesconto($vlPrincipal, $pcDesconto)
    {
        return ($vlPrincipal - ($vlPrincipal * $pcDesconto) / 100);
    }
}