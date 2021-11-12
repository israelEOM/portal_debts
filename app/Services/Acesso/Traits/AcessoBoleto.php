<?php
namespace App\Services\Acesso\Traits;


use App\Repositories\Acesso\AcessoBoletoRepository;

/**
 *
 */
Trait AcessoBoleto
{
	public function acessoBoletoFatura($dataSet)
	{
		$repository = new AcessoBoletoRepository();
		$repository->idAcesso = $dataSet->idAcesso;
		$repository->idAcessoContrato = $this->idAcessoContrato;
		$repository->idContrato = $this->idContrato;
		$repository->idBoleto = $dataSet->boleto->id;
		$repository->getByAcessoContratoBoleto();
		$repository->stBtPagar = 1;
		$repository->vlBoleto = $dataSet->boleto->valor;
		$repository->dtVencimento = $dataSet->boleto->dtVencimento;

		if($repository->exist()){
			$repository->update();
		}
		else{
			$repository->store();
		}
	}

	public function acessoBoleto($dataSet)
	{
		switch ($dataSet->acao) {
			case '1':
				$dataSet->stBtPagar = 1;
			break;
			case '2':
				$dataSet->stBtPagar = 1;
				$dataSet->stBtLinhaDigitavel = 1;
			break;
			case '3':
				$dataSet->stBtPagar = 1;
				$dataSet->idBtGeraBoleto = 1;
			break;
		}

		$repository = new AcessoBoletoRepository();
		$repository->idAcesso = $dataSet->acesso->id;
		$repository->idAcessoContrato = $dataSet->acesso->idAcessoContrato;
		$repository->idAcessoNegociacao = $dataSet->acesso->idAcessoNegociacao;
		$repository->idContrato = $dataSet->acesso->idContrato;
		$repository->idBoleto = $dataSet->idBoleto;
		$repository->getByAcessoContratoBoleto();
		$repository->stBtPagar = $dataSet->stBtPagar;
		$repository->stBtLinhaDigitavel = isset($dataSet->stBtLinhaDigitavel) ? 1 : $repository->stBtLinhaDigitavel;
		$repository->idBtGeraBoleto = isset($dataSet->idBtGeraBoleto) ? 1 : $repository->idBtGeraBoleto;
		$repository->vlBoleto = $dataSet->vlBoleto;
		$repository->dtVencimento = $dataSet->dtVencimento;

		if($repository->exist()){
			$repository->update();
		}
		else{
			$repository->store();
		}
	}
}