<?php
namespace App\Repositories\Empresa;


use App\Repositories\BaseRepository;
use App\Models\Empresa\Empresa;


class EmpresaRepository extends BaseRepository
{
    public function model()
    {
    	return Empresa::class;
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

    public function getByEmpresa($empresa)
    {
        $this->filledModel(
                $this->model->where("VLEMP_EMP", $empresa)
                ->where("stemp_emp", 1)
                ->first()
            );
    }
}