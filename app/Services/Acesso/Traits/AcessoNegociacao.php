<?php
namespace App\Services\Acesso\Traits;


use App\Repositories\Acesso\AcessoNegociacaoRepository;

/**
 *
 */
Trait AcessoNegociacao
{
	public $idAcessoNegociacao;

	public function acessoNegociacao($codigo, $faixa)
	{
		$repository = new AcessoNegociacaoRepository();
		$repository->idAcesso = $this->repository->id;
		$repository->idAcessoContrato = $this->idAcessoContrato;
		$repository->codigo = strtoupper($codigo);
		$repository->faixa = strtoupper($faixa);
		$repository->getByAcesso();

		$status = $repository->store();

		$this->idAcessoNegociacao = $repository->id;
	}
}