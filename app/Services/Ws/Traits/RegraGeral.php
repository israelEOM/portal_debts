<?php
namespace App\Services\Ws\Traits;


use Carbon\Carbon;
use Exception;
use Arr;

trait RegraGeral
{
    public function regraNegociado()
    {
         if($this->contrato->stAcordo || $this->contrato->stPromessa || $this->contrato->stProposta){

            $this->negociados->push($this->contrato);

            return;
        }

        if($this->empresa->stTitulo){

            $this->negociados->push($this->contrato);

            $this->contrato->stDivida = false;

            return;
        }
    }

    public function regraPendente()
    {
        if($this->contrato->stDivida){
            $this->pendentes->push($this->contrato);
        }
    }

    public function regraDtVencimento()
    {
        $dt = now()->addDays($this->empresa->qtDiaVencimento);

        $add = true;
        while($add){
            if($dt->isWeekDay()){
                $add = false;
            }
            else{
                $dt->addDay();
            }
        }

        $this->contrato->dtVencimento = $dt->format("Y-m-d");
    }

    public function regraTpNegociacao()
    {
        if($this->empresa->stProposta){
            $this->contrato->tpNegociacao = 1;
        }

        else if($this->empresa->stTitulo){
            $this->contrato->tpNegociacao = 2;
        }

        else if($this->empresa->stAcordo){
            $this->contrato->tpNegociacao = 3;
        }
    }
}