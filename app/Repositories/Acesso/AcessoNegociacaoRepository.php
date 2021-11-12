<?php
namespace App\Repositories\Acesso;


use App\Repositories\BaseRepository;
use App\Models\Acesso\AcessoNegociacao;


class AcessoNegociacaoRepository extends BaseRepository
{
    public function model()
    {
        return AcessoNegociacao::class;
    }

    public function store()
    {
        $this->qtAcesso += 1;

        return $this->save();
    }

    public function getByAcesso()
    {
        $this->filledModel(
            $this->model->where("IDACO_ANE", $this->idAcessoContrato)
            ->where("VLFAI_ANE", $this->faixa)
            ->first()
        );
    }
}