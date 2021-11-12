<?php
namespace App\Services\Cliente;



use App\Services\BaseService;
use App\Repositories\Cliente\ClienteRepository;

/**
 *
 */
class ClienteService extends BaseService
{
	private $repository;

	public function __construct()
	{
		$this->repository = new ClienteRepository();
	}

	public function store(array $dataSet, $validate = false)
	{
		$this->repository->getByCgCpf($dataSet["cgcpf"]);

		$this->create($dataSet);
	}

	private function create($dataSet)
	{
		$this->repository->dynamicAttributes($dataSet);

		if($this->repository->store())
			return ["id" => $this->repository->id, "type" => "success"];

		return ["type" => "error"];
	}

	public function update($id, array $dataSet)
	{
		$this->repository->find($id);
		$this->repository->dynamicAttributes($dataSet);

		if($this->repository->update())
			return ["id" => $this->repository->id, "type" => "success"];

		return ["type" => "error"];
	}

	public function updateName($nome)
	{
		$this->repository->nome = strtoupper(trim(preg_replace('/\s+/S', " ", $nome)));
        $this->repository->update();
	}

	public function getId()
	{
		return $this->repository->id;
	}

	public function getCpf()
	{
		return $this->repository->cgcpf;
	}

	public function getByCgCpf($cgCpf)
    {
        return $this->repository->getByCgCpf($cgCpf);
    }

    public function getRepository()
    {
        return $this->repository->toJson();
    }
}