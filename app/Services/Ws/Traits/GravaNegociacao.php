<?php
namespace App\Services\Ws\Traits;

use App\Repositories\Empresa\EmpresaRepository;
use Exception;
use Arr;
use stdClass;

trait GravaNegociacao
{
    private $negociacao;

    public function gravaNegociacao($nectar, $parcela)
    {
        if($this->validateRecordsTrading($nectar->Resultado)){

            $this->acesso->acessoAcordo($parcela);

            $this->empresa = new EmpresaRepository();

            $this->dividaByContrato($this->nectar->divida());

            $this->response->contrato->dividas = [];
        }

        $this->response->acesso = $this->acesso->getRepository();
    }

    private function regraBoleto()
    {
        $this->contrato = $this->negociados->get($this->negociacao->idContrato);

        if($this->contrato){
            $this->response->acordo = $this->contrato->dividas->first();

            $this->nectar->setTpBoleto($this->contrato->tpNegociacao);
            $this->nectar->setIdBoleto($this->response->acordo->idBoleto);

            if($this->negociacao->empresa->stAceite){

                $this->response->acordo->stBoleto = false;
                $this->response->status = true;
            }
            else{

                $this->boleto($this->nectar->boleto());
            }
        }
        else{

            $this->response->status = false;
        }
    }

    private function validateRecordsTrading($resultado)
    {
        if(intval($resultado->CodigoMensagem) == 17)
            return true;

        $this->response->status = false;
        $this->response->stFinalizador = false;

        $this->response->msg = "Ocorreu uma falha na comunicação. Tente novamente - {$resultado->Mensagem}";
        $this->response->msgWs = $resultado->Mensagem;

        $this->acesso->storeResponse($resultado->Mensagem, 3, $this->negociacao->empresa->id);

        return false;
    }
}