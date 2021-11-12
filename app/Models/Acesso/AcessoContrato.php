<?php

namespace App\Models\Acesso;


use App\Models\BaseModel;

class AcessoContrato extends BaseModel
{
    public $timestamps = false;

    protected $table = 'Tb_AcessoContrato';

    protected $primaryKey = 'IDACO_ACO';

    public $aliases = [
		'id' => 'IDACO_ACO',
		'idAcesso' => 'IDACE_ACO',
		'idContrato' => 'IDCON_ACO',
	    'qtAcesso' => 'QTACO_ACO',
	    'stRiachuelo' => 'STPRI_ACO',
	    'dtCadastro' => 'DTCAD_ACO'
	];
}