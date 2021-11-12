<?php
namespace App\Services\Acesso\Traits;


use App\Repositories\Acesso\AcessoContratoRepository;

/**
 *
 */
Trait AcessoContrato
{
	private $idContrato;
	private $idAcessoContrato;

	public function acessoContrato($idContrato)
	{
		$repository = new AcessoContratoRepository();
        $repository->idAcesso = $this->repository->id;
        $repository->idContrato = $idContrato;
        $repository->getByContratoAcesso();
		$repository->store();

		$this->idContrato = $idContrato;
		$this->idAcessoContrato = $repository->id;
	}

	public function acessoContratoRiachuelo($idAcesso, $idContrato)
	{
		$repository = new AcessoContratoRepository();
		$repository->idAcesso = $idAcesso;
        $repository->idContrato = $idContrato;
        $repository->getByContratoAcesso();
        $repository->stRiachuelo = 1;
		$repository->store();
	}

	public function setIdAcessoContrato($idAcessoContrato)
	{
		$this->idAcessoContrato = $idAcessoContrato;
	}

	public function setIdContrato($idContrato)
	{
		$this->idContrato = $idContrato;
	}
}