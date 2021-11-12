<?php
namespace App\Services\Acesso\Traits;


use App\Repositories\Acesso\AcessoResponseRepository;

/**
 *
 */
Trait AcessoResponse
{
	public function acessoResponse($idAcesso, $idEmpresa, $msg)
	{
		$this->repository->find($idAcesso);

		$this->createAcessoResponse([
			"idAcesso" => $idAcesso,
			"idEmpresa" => $idEmpresa,
			"response" => $msg
		]);
	}

	public function storeResponse($msg, $metodo, $idEmpresa = null)
	{
		$this->createAcessoResponse(["idAcesso" => $this->repository->id,
			"metodo" => $metodo,
			"idEmpresa" => $idEmpresa,
			"idContrato" => $this->idContrato,
			"response" => $msg
		]);
	}

	private function createAcessoResponse($dataSet)
	{
		$acessoResponseRepository = new AcessoResponseRepository();
		$acessoResponseRepository->dynamicAttributes($dataSet);

		$status = $acessoResponseRepository->store();

		if($status){
			return [
				"id" => $acessoResponseRepository->id,
				"type" => "success"
			];
		}
		else{
			return [
				"type" => "error"
			];
		}
	}
}