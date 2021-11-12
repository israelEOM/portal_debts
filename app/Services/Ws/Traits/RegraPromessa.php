<?php
namespace App\Services\Ws\Traits;


use Carbon\Carbon;
use Exception;
use Arr;
use stdClass;

trait RegraPromessa
{
    public function promessa()
    {
        $this->contrato->stPromessa = false;

        if(empty($this->contrato->Promessa) || $this->contrato->stAcordo || $this->contrato->stProposta)
            return false;

        $this->contrato->dividas = collect();

        $promessas = is_array($this->contrato->Promessa) ? $this->contrato->Promessa : [$this->contrato->Promessa];

        foreach ($promessas as $promessa) {
            $this->regraPromessa($promessa->Promessa);
        }
    }

    private function regraPromessa($parcelas)
    {
        $parcelas = is_array($parcelas) ? $parcelas : [$parcelas];

        foreach ($parcelas as $parcela) {
            $this->contrato->stPromessa = false;

            if($this->validateDtVencimento($parcela->DataVencimento)){

                $acordo = new stdClass();
                $acordo->id = $parcela->IdPromessa;
                // $acordo->descricao = $parcela->Descricao;
                $acordo->parcela = $parcela->Parcelas;
                $acordo->valor = $parcela->ValorEntrada;
                $acordo->dtPromessa = $parcela->DataPromessa;
                $acordo->dtVencimento = $parcela->DataVencimento;
                $acordo->stDownload = false;

                $this->contrato->dividas->push($acordo);

                $this->contrato->stPromessa = true;
            }
        }
    }
}