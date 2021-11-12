<?php
namespace App\Services\Acesso;



use App\Services\BaseService;
use App\Repositories\Acesso\AcessoRepository;
use App\Services\Acesso\Traits\{
	AcessoContrato,
	AcessoNegociacao,
	AcessoAcordo,
	AcessoBoleto,
	AcessoResponse
};


/**
 *
 */
class AcessoService extends BaseService
{
	use AcessoContrato, AcessoNegociacao, AcessoAcordo, AcessoBoleto, AcessoResponse;

	private $repository;

	public function __construct()
	{
		$this->repository = new AcessoRepository();
	}

	public function store(array $dataSet, $validate = false)
	{
		return $this->create($dataSet);
	}

	private function create($dataSet)
	{
		$this->repository->dynamicAttributes($dataSet);
		$this->repository->getByCliente();

		$status = $this->repository->store();

		if($status){
			return [
				"id" => $this->repository->id,
				"type" => "success"
			];
		}
		else{
			return [
				"type" => "error"
			];
		}
	}

	public function update($id, array $dataSet)
	{
		$this->repository->dynamicAttributes($dataSet);

        $status = $this->repository->update();

		if($status){
			return [
				"id" => $this->repository->id,
				"type" => "success"
			];
		}
		else{
			return [
				"type" => "error"
			];
		}
	}

	public function getId()
	{
		return $this->repository->id;
	}

	public function findById($id)
	{
		$this->repository = $this->repository->find($id);
	}

	public function setId($id)
	{
		$this->repository->id = $id;
	}

	public function getByContratoNegociacao($idContrato, $idNegociacao)
    {
        return $this->repository->getByContratoNegociacao($idContrato, $idNegociacao)->first();
    }

    public function getRepository()
    {
        return ["id" => $this->repository->id,
        	"idAcessoContrato" => $this->idAcessoContrato,
        	"idAcessoNegociacao" => $this->idAcessoNegociacao,
        	"idContrato" => $this->idContrato
        ];
    }
}