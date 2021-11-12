<?php
namespace App\Services\Ws\Traits;


use Carbon\Carbon;
use Exception;
use Arr;
use stdClass;

trait RegraProposta
{
    public function proposta()
    {
        $this->contrato->stProposta = false;

        if(empty($this->contrato->Campanha) || $this->contrato->stAcordo)
            return false;

        $this->contrato->dividas = collect();

        $propostas = is_array($this->contrato->Campanha) ? $this->contrato->Campanha : [$this->contrato->Campanha];

        foreach ($propostas as $proposta) {
            $proposta = $proposta->Campanha;

            if($proposta->Origem != 1)
                continue;

            $this->contrato->idProposta = $proposta->IDPRO_PRO;
            $this->contrato->vlOriginal = 0;
            $this->contrato->vlCorrigido = 0;
            $this->contrato->vlDesconto = ($proposta->DescontoPrincipal + $proposta->DescontoEncargos);
            $this->contrato->vlAcordo = 0;

            $this->regraProposta($proposta->DividasCampanha);
        }
    }

    private function regraProposta($proposta)
    {
        $titulos = is_array($proposta->DividaCampanha) ? $proposta->DividaCampanha : [$proposta->DividaCampanha];

        foreach ($titulos as $titulo) {

            $this->contrato->stProposta = true;

            $this->contrato->vlCorrigido += $titulo->ValorAtualizado;
            $this->contrato->vlOriginal += $titulo->ValorOriginal;

            $divida = new stdClass();
            $divida->idTitulo = $titulo->IDTRA;
            $divida->descricao = trim($titulo->Descricao);
            $divida->vlCorrigido = $titulo->ValorAtualizado;
            $divida->vlOriginal = $titulo->ValorOriginal;
            $divida->dtVencimento = $titulo->DataVencimento;
            $divida->stDownload = false;

            $this->contrato->dividas->push($divida);
        }

        $this->contrato->vlAcordo = $this->contrato->vlCorrigido - $this->contrato->vlDesconto;
    }
}