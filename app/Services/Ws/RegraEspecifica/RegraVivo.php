<?php
namespace App\Services\Ws\RegraEspecifica;


use Arr;

/**
 *
 */
class RegraVivo
{
	public function regraEspecifica($contrato)
	{
		$carteira = Arr::last(explode("-", $contrato->contrato));

		if($carteira == "ATL"){
			$contrato->stAcordo = true;
			$contrato->stDivida = false;
		}

		return $contrato;
	}
}