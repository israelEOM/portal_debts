<?php

namespace App\Models\Acesso;


use App\Models\BaseModel;

class AcessoResponse extends BaseModel
{
    public $timestamps = false;

    protected $table = 'Tb_AcessoResponse';

    protected $primaryKey = 'IDARE_ARE';

    public $aliases = [
		'id' => 'IDARE_ARE',
		'idAcesso' => 'IDACE_ARE',
		'idEmpresa' => 'IDEMP_ARE',
		'idContrato' => 'IDCON_ARE',
		'metodo' => 'VLMET_ARE',
		'response' => 'VLRES_ARE',
		'dtCadastro' => 'DTCAD_ARE'
	];
}