<?php

namespace App\Models\Cliente;


use App\Models\BaseModel;

class Cliente extends BaseModel
{
    public $timestamps = false;

    protected $table = 'Tb_Cliente';

    protected $primaryKey = 'IDCLI_CLI';

    public $aliases = [
		"id" => "IDCLI_CLI",
		"cgcpf" => "VLCPF_CLI",
		"nome" => "VLNOM_CLI",
		"dtCadastro" => "DTCAD_CLI",
		"dtAtualizacao" => "DTATU_CLI"
	];
}