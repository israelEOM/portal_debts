<?php
namespace App\Repositories\Acesso;


use App\Repositories\BaseRepository;
use App\Models\Acesso\AcessoBoleto;


class AcessoBoletoRepository extends BaseRepository
{
    public function model()
    {
    	return AcessoBoleto::class;
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

    public function getByAcessoContratoBoleto()
    {
        $this->filledModel(
            $this->model->where("IDACE_ABO", $this->idAcesso)
            ->where("IDCON_ABO", $this->idContrato)
            ->where("IDBOL_ABO", $this->idBoleto)
            ->first()
        );
    }
}