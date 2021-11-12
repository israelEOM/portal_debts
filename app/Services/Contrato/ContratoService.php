<?php
namespace App\Services\Contrato;



use App\Services\BaseService;
use App\Repositories\Contrato\ContratoRepository;

/**
 *
 */
class ContratoService extends BaseService
{
	private $contratoRepository;

	public function __construct()
	{
		$this->repository = new ContratoRepository();
	}

	public function store(array $dataSet, $validate = false)
	{
		$this->repository->getByIdCrmServer($dataSet["idCrm"], $dataSet["idServidor"]);

		$this->create($dataSet);
	}

	private function create($dataSet)
	{
		$this->repository->dynamicAttributes($dataSet);

		if($this->repository->store()){

			return ["id" => $this->repository->id, "type" => "success"];
		}

		return ["type" => "error"];
	}

	public function update($id, array $dataSet)
	{
		$this->repository->find($id);
		$this->repository->dynamicAttributes($dataSet);

		if($this->repository->update()){

			return ["id" => $this->repository->id, "type" => "success"];
		}

		return ["type" => "error"];
	}

	public function getId()
	{
		return $this->repository->id;
	}

	public function getByIdCrmServer($idCrm, $idServidor)
    {
        return $this->repository->getByIdCrmServer($idCrm, $idServidor);
    }
}