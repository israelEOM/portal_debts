<?php

namespace App\Models\Acesso;


use App\Models\BaseModel;

class AcessoNegociacao extends BaseModel
{
    public $timestamps = false;

    protected $table = 'Tb_AcessoNegociacao';

    protected $primaryKey = 'IDANE_ANE';

    public $aliases = [
		'id' => 'IDANE_ANE',
		'idAcesso' => 'IDACE_ANE',
		'idAcessoContrato' => 'IDACO_ANE',
		'codigo' => 'VLCOD_ANE',
		'faixa' => 'VLFAI_ANE',
	    'qtAcesso' => 'QTANE_ANE',
	    'dtCadastro' => 'DTCAD_ANE'
	];
}
