<?php

namespace App\Models\Contrato;

use App\Models\BaseModel;

class Contrato extends BaseModel
{
    public $timestamps = false;

    protected $table = 'Tb_Contrato';

    protected $primaryKey = 'IDCON_CON';

    public $aliases = [
		'id' => 'IDCON_CON',
		'idCliente' => 'IDCLI_CON',
		'idServidor' => 'IDSER_CON',
		'idCrm' => 'IDCRM_CON',
		'idEmpresa' => 'IDEMP_CON',
	    'dtCadastro' => 'DTCAD_CON',
	    'dtAtualizacao' => 'DTATU_CON'
	];
}
