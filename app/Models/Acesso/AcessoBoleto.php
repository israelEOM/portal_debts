<?php

namespace App\Models\Acesso;


use App\Models\BaseModel;

class AcessoBoleto extends BaseModel
{
    public $timestamps = false;

    protected $table = 'Tb_AcessoBoleto';

    protected $primaryKey = 'IDABO_ABO';

    public $aliases = [
		'id' => 'IDABO_ABO',
		'idAcesso' => 'IDACE_ABO',
		'idContrato' => 'IDCON_ABO',
		'idBoleto' => 'IDBOL_ABO',
		'stBtPagar' => 'STBPA_ABO',
		'stBtLinhaDigitavel' => 'STBLD_ABO',
		'idBtGeraBoleto' => 'STBGB_ABO',
		'vlBoleto' => 'VLBOL_ABO',
		'dtVencimento' => 'DTVEN_ABO',
	    'dtCadastro' => 'DTCAD_ABO',
	    'dtAtualizacao' => 'DTATU_ABO'
	];
}