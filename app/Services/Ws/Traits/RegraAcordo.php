<?php
namespace App\Services\Ws\Traits;


use Carbon\Carbon;
use Exception;
use Arr;
use stdClass;

trait RegraAcordo
{
    public function regraAcordo()
    {
        $this->contrato->stAcordo = false;

        if(empty($this->contrato->Acordo))
            return false;

        $acordos = is_array($this->contrato->Acordo) ? $this->contrato->Acordo : [$this->contrato->Acordo];

        foreach ($acordos as $acordo) {
            $this->contrato->stAcordo = false;
            $this->contrato->dividas = collect();

            $this->regraParcela($acordo->AcordoParcela->AcordoParcela);
        }
    }

    private function regraParcela($parcelas)
    {
        $parcelas = is_array($parcelas) ? $parcelas : [$parcelas];

        foreach ($parcelas as $parcela) {
            $this->contrato->stAcordo = false;

            if(empty($parcela->DataPagamento))
                $this->contrato->stAcordo = $this->validateDtVencimento($parcela->DataVencimento);

            if($this->contrato->stAcordo){
                $acordo = new stdClass();
                $acordo->id = $parcela->IDParcela;
                $acordo->descricao = $parcela->Descricao;
                $acordo->parcela = $parcela->NumeroParcela;
                $acordo->valor = $parcela->ValorParcela;
                $acordo->dtVencimento = $parcela->DataVencimento;
                $acordo->stDownload = true;

                $this->contrato->dividas->push($acordo);

                return true;
            }
        }
    }

    private function validateDtVencimento($dtVencimento)
    {
        return Carbon::parse($dtVencimento)->startOfDay()->gt($this->data);
    }
}