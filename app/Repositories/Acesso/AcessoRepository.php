<?php
namespace App\Repositories\Acesso;


use App\Repositories\BaseRepository;
use App\Models\Acesso\Acesso;


class AcessoRepository extends BaseRepository
{
    public function model()
    {
    	return Acesso::class;
    }

    public function store()
    {
		return $this->save();
    }

    public function update()
    {
        return $this->save();
    }

    public function getByCliente()
    {
        $this->filledModel(
            $this->model->where("IDCLI_ACE", $this->idCliente)
            ->whereBetween("DTCAD_ACE", [now()->subMinutes(5), now()])
            ->first()
        );
    }
}