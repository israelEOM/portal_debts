<?php
namespace App\Repositories\Acesso;


use App\Repositories\BaseRepository;
use App\Models\Acesso\AcessoContrato;


class AcessoContratoRepository extends BaseRepository
{
    public function model()
    {
        return AcessoContrato::class;
    }

    public function store()
    {
        $this->qtAcesso += 1;

        return $this->save();
    }

    public function getByContratoAcesso()
    {
        $this->filledModel(
            $this->model->where("IDACE_ACO", $this->idAcesso)
            ->where("IDCON_ACO", $this->idContrato)
            ->first()
        );
    }
}