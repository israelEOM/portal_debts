<?php
namespace App\Services\Ws\Traits;


use Exception;
use Arr;
use stdClass;

trait Boleto
{
    public $acordo;

    public function boleto($nectar)
    {
        if($this->validadeBoleto($nectar->Resultado->Resultado)){

            $this->treatBill($nectar->BoletoAcordo->BoletoAcordo);
        }

        $this->response->acesso = $this->acesso->getRepository();
    }

    private function validadeBoleto($resultado)
    {
        if($resultado->Mensagem == "Sucesso"){
            return true;
        }

        $this->response->status = false;
        $this->response->stFinalizador = false;

        $this->response->msg = "Ocorreu uma falha na comunicação. Tente novamente";
        $this->response->msgWs = $resultado->Mensagem;

        $this->acesso->storeResponse($resultado->Mensagem, 4);

        return false;
    }

    private function treatBill($boleto)
    {  
        $this->response->boleto->linhaDigitavel = str_replace([" ", "."], "", $boleto->LinhaDigitavel);
        $this->response->boleto->cdBarra = $boleto->CodigoBarras;
        $this->response->boleto->pdf = $boleto->RetornoPDF;
        $this->response->boleto->stBoleto = true;

        $this->response->status = true;
    }
}