<?php
namespace App\Repositories\Acesso;


use App\Repositories\BaseRepository;
use App\Models\Acesso\AcessoAcordo;


class AcessoAcordoRepository extends BaseRepository
{
    public function model()
    {
    	return AcessoAcordo::class;
    }

    public function store()
    {
		return $this->save();
    }
}