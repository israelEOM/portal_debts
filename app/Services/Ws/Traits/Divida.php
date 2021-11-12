<?php
namespace App\Services\Ws\Traits;


use Exception;
use Arr;
use Carbon\Carbon;
use ReflectionClass;

trait Divida
{
    private $contrato;

    public function divida($nectar)
    {
        if($this->validadeDebt($nectar->Resultado->Resultado)){

            $this->cliente->updateName($nectar->NomeCliente);

            $this->acesso->update(0, ["stCliente" => 1]);

            $this->data = now()->startOfDay();

            $this->response->status = false;

            $this->treatContracts($nectar->Contrato);

            $this->mutatorResponse();
        }
    }

    public function dividaByContrato($nectar)
    {
        if($this->validadeDebt($nectar->Resultado->Resultado)){

            $this->treatContracts($nectar->Contrato);

            $this->mutatorResponse();
        }
    }

    private function treatContracts($contratos)
    {
        if(empty($contratos))
            return false;

        $contratos = is_array($contratos->Contrato) ? $contratos->Contrato : [$contratos->Contrato];

        $this->response->vlTotal = 0;

        foreach ($contratos as $this->contrato) {

            if(strtoupper(trim($this->contrato->NomeFantasia)) != "CARREFOUR CYBER")
                continue;

            $this->contrato->NomeFantasia = trim($this->contrato->NomeFantasia);

            $this->empresa->getByEmpresa(strtoupper($this->contrato->NomeFantasia));

            $this->regraDtVencimento();

            $this->regraAcordo();

            $this->proposta();

            $this->promessa();

            $this->regraDivida();

            $this->clear();

            $this->regraTpNegociacao();

            $this->regraEspecifica();

            $this->regraNegociado();

            $this->regraPendente();

            $this->getNegociacoes();
        }

        $this->contrato = null;
    }

    private function mutatorResponse()
    {
        if($this->empresa->exist()){
            $this->response->cliente = $this->cliente->getRepository();
            $this->response->acesso = $this->acesso->getRepository();
            $this->response->negociados = $this->negociados;
            $this->response->pendentes = $this->pendentes;
            $this->response->empresa = $this->empresa->toJson();

            $this->response->status = true;
        }
    }

    private function validadeDebt($resultado)
    {
        if(intval($resultado->CodigoMensagem) == 18){
            return true;
        }

        $this->response->status = false;
        $this->response->stFinalizador = false;

        if(intval($resultado->CodigoMensagem) == 12){
            $this->response->msg = "CPF/CNPJ não encontrado";
            $this->response->stFinalizador = true;
        }

        else{
            $this->response->msg = "Ocorreu uma falha na comunicação. Tente novamente  - {$resultado->Mensagem}";
            $this->acesso->storeResponse($resultado->Mensagem, 1);
        }

        return false;
    }

    private function regraEspecifica()
    {
        if(empty($this->empresa->regraEspecifica))
            return false;

        // $class = "App\Services\Ws\RegraEspecifica\{$this->empresa->regraEspecifica}";

        $instance = new ReflectionClass("App\Services\Ws\RegraEspecifica\{$this->empresa->regraEspecifica}");
        $instance = $instance->newInstanceArgs();

        $this->contrato = $instance->regraEspecifica($this->contrato);
    }

    private function clear()
    {
        $this->contrato->contrato = $this->contrato->Contrato;
        $this->contrato->idContrato = $this->contrato->IDCON;
        $this->contrato->idServidor = $this->contrato->IDSERV;
        $this->contrato->tpNegociacao = $this->contrato->TipoNegociacao;

        unset($this->contrato->Acordo, $this->contrato->Divida, $this->contrato->Promessa, $this->contrato->Campanha);
        unset($this->contrato->Agrupamento, $this->contrato->Contrato, $this->contrato->IDCON, $this->contrato->IDSERV);
        unset($this->contrato->Informacoes, $this->contrato->UtilizaWS, $this->contrato->TipoNegociacao, $this->contrato->AutorizacaoDeAcordo);
    }
}