<?php
namespace App\Services\Acesso\Traits;


use App\Repositories\Acesso\AcessoAcordoRepository;

/**
 *
 */
Trait AcessoAcordo
{
	private $idAcessoAcordo;

	public function acessoAcordo($dataSet)
	{
		$repository = new AcessoAcordoRepository();
		$repository->idAcesso = $this->repository->id;
		$repository->idAcessoContrato = $this->idAcessoContrato;
		$repository->idAcessoNegociacao = $this->idAcessoNegociacao;
		$repository->idContrato = $this->idContrato;
		$repository->vlOriginal = $dataSet->vlOriginal;
		$repository->vlNegociado = $dataSet->vlNegociar;
		$repository->qtParcela = $dataSet->qtParcela;
		$repository->dtVencimento = $dataSet->dtVencimento;
		$repository->vlEntrada = $dataSet->vlEntrada;
		$repository->vlDemais = $dataSet->vlDemais;

		$repository->store();

		$this->idAcessoAcordo = $repository->id;
	}

	public function updateAcessoAcordo($dataSet)
	{
		$repository = new AcessoAcordoRepository();
		$repository->find($this->idAcessoAcordo);
		$repository->dynamicAttributes($dataSet);

		$repository->store();
	}
}