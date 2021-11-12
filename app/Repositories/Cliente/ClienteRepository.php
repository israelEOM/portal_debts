<?php
namespace App\Repositories\Cliente;


use App\Repositories\BaseRepository;
use App\Models\Cliente\Cliente;


class ClienteRepository extends BaseRepository
{
    public function model()
    {
    	return Cliente::class;
    }

    public function store()
    {
		return $this->save();
    }

    public function update()
    {
        // $this->idUsuario = auth()->id();
        $this->dtAtualizacao = now();

        return $this->save();
    }

    public function getByCgCpf($cgCpf)
    {
        $this->filledModel($this->model->where("VLCPF_CLI", $cgCpf)->first());
    }
}