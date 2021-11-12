<?php

namespace App\Models\Acesso;


use App\Models\BaseModel;

class Acesso extends BaseModel
{
    public $timestamps = false;

    protected $table = 'Tb_Acesso';

    protected $primaryKey = 'IDACE_ACE';

    public $aliases = [
		'id' => 'IDACE_ACE',
		'idCliente' => 'IDCLI_ACE',
		'cpf' => 'VLCPF_ACE',
		'stCliente' => 'STCLI_ACE',
	    'dtCadstro' => 'DTCAD_ACE',
	    'dtAtualizacao' => 'DTATU_ACE'
	];
}