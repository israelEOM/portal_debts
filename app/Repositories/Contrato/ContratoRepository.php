<?php
namespace App\Repositories\Contrato;


use App\Repositories\BaseRepository;
use App\Models\Contrato\Contrato;


class ContratoRepository extends BaseRepository
{
    public function model()
    {
    	return Contrato::class;
    }

    public function store()
    {
		return $this->save();
    }

    public function update()
    {
        $this->dtAtualizacao = now();

        return $this->save();
    }

    public function getByIdCrmServer($idCrm, $idServidor)
    {
        $this->filledModel(
                $this->model->where("IDCRM_CON", $idCrm)
                ->where("IDSER_CON", $idServidor)
                ->first()
            );
    }
}