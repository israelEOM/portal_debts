<?php

namespace App\Models\Acesso;


use App\Models\BaseModel;

class AcessoAcordo extends BaseModel
{
    public $timestamps = false;

    protected $table = "Tb_AcessoAcordo";

    protected $primaryKey = "IDAAC_AAC";

    public $aliases = [
		"id" => "IDAAC_AAC",
		"idAcesso" => "IDACE_AAC",
		"idAcessoContrato" => "IDACO_AAC",
		"idAcessoNegociacao" => "IDANE_AAC",
		"idContrato" => "IDCON_AAC",
		"qtParcela" => "QTPAR_AAC",
		"vlOriginal" => "VLORI_AAC",
		"vlNegociado" => "VLNEG_AAC",
		"vlEntrada" => "VLENT_AAC",
		"vlDemais" => "VLDEM_AAC",
		"stBoleto" => "STBOL_AAC",
		"dtVencimento" => "DTVEN_AAC",
	    "dtCadastro" => "DTCAD_AAC"
	];
}