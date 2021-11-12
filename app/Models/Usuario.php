<?php

namespace App\Models;

class Usuario extends BaseModel
{
    public $timestamps = false;

    protected $table = 'Tb_Usuario';

    protected $primaryKey = 'IDCLI_CLI';

    public $aliases = [
		"id" => "IDCLI_CLI",
		"cgcpf" => "CGCPF_CLI",
		"nome" => "VLNOM_CLI",
		"dtCadastro" => "DTCAD_CLI",
		"dtAtualizacao" => "DTATU_CLI"
	];
}
