<?php
namespace App\Repositories\Acesso;


use App\Repositories\BaseRepository;
use App\Models\Acesso\AcessoResponse;


class AcessoResponseRepository extends BaseRepository
{
    public function model()
    {
    	return AcessoResponse::class;
    }

    public function store()
    {
		return $this->save();
    }
}