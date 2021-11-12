<?php

namespace App\Models\Empresa;

use App\Models\BaseModel;

class Empresa extends BaseModel
{
    public $timestamps = false;

    protected $table = 'Tb_Empresa';

    protected $primaryKey = 'IDEMP_EMP';

    public $aliases = [
		'id' => 'IDEMP_EMP',
		'idEmpresaCrm' => 'IDCRM_EMP',
		'empresa' => 'VLEMP_EMP',
		'stTitulo' => 'STTIT_EMP',
		'stProposta' => 'STPRO_EMP',
		'stAcordo' => 'STACO_EMP',
		'qtDiaVencimento' => 'QTVEN_EMP',
		'stEmpresa' => 'STEMP_EMP',
		'stAceite' => 'STACE_EMP',
		'regraEspecifica' => 'VLRUL_EMP',
	    'dtCadastro' => 'DTCAD_EMP',
	    'dtAtualizacao' => 'DTATU_EMP'
	];
}