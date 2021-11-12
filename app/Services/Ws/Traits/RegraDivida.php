<?php
namespace App\Services\Ws\Traits;


use Carbon\Carbon;
use Exception;
use Arr;
use stdClass;

trait RegraDivida
{
    public function regraDivida()
    {
        $this->contrato->stDivida = false;

        if($this->contrato->stPromessa || $this->contrato->stProposta || $this->contrato->stAcordo || empty($this->contrato->Divida))
            return false;

        $dividas = $this->contrato->Divida;

        $this->contrato->dividas = collect();

        $dividas = is_array($dividas->Divida) ? $dividas->Divida : [$dividas->Divida];

        foreach ($dividas as $divida) {
            $this->contrato->stDivida = false;

            $this->validateDescricao($divida->Descricao);

            $this->validateDtDevolucao($divida->DataDevolucao);

            if($this->contrato->stDivida){

                $std = new stdClass();
                $std->idTitulo = $divida->IDTRA;
                $std->descricao = $divida->Descricao;
                $std->vlOriginal = $divida->ValorOriginal;
                $std->vlAtualizado = $divida->ValorAtualizado;
                $std->idBoleto = $std->idTitulo;
                $std->vlBoleto = $divida->ValorAtualizado;
                $std->parcela =  1;
                $std->dtVencimento = $this->regraDtVencimentoTitulo($divida->DataVencimento);

                $this->contrato->dividas->push($std);

                $this->response->vlTotal += $divida->ValorAtualizado;
            }
        }
    }

    private function regraDtVencimentoTitulo($dtVencimento)
    {
        if($this->empresa->stTitulo){

            if(Carbon::parse($dtVencimento)->startOfDay()->lt($this->data)){
                return $this->contrato->dtVencimento;
            }
        }

        return $dtVencimento;
    }

    private function validateDescricao($descricao)
    {
        if(strtoupper($descricao) != "SALDO A VENCER"){
            $this->contrato->stDivida = true;
        }
    }

    private function validateDtDevolucao($dtDevolucao)
    {
        if(Carbon::parse($dtDevolucao)->startOfDay()->gt($this->data)){
            $this->contrato->stDivida = true;
        }
    }
}