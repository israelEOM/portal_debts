<?php
namespace App\Services\Desenv\Helpers;


use Validator;

/**
 * summary
 */
class DataRow
{
	public $valido = false;
	public $falhas = [];

	public static function DataRowGeral(array $dataSet)
	{
		$me = new static;
		$me->origem = $dataSet[0];
		$me->lote = $dataSet[1];
		$me->empresa = str_replace_accents($dataSet[2]);
		$me->carteira = str_replace_accents($dataSet[3]);
		$me->ddd = $dataSet[4];
		$me->telefone = $dataSet[5];
		$me->whats = $dataSet[6];
		$me->email = $dataSet[7];
		$me->cpfCnpj = $dataSet[8];
		$me->contrato = $dataSet[9];
		$me->contaContrato = $dataSet[10];
		$me->referencia = $dataSet[11];
		$me->mercadoria = $dataSet[12];
		$me->nome = str_replace_accents($dataSet[13]);
		$me->valorAtualizado = $dataSet[14];
		$me->valorTitulo = $dataSet[15];
		$me->dtVencimentoTitulo = date_banco($dataSet[16]);
		$me->numeroTitulo = $dataSet[17];
		$me->codBarraTitulo = $dataSet[18];
		$me->linhaDigitavelTitulo = $dataSet[19];
		$me->valorProposta = $dataSet[20];
		$me->dtVencimentoProposta = date_banco($dataSet[21]);
		$me->numeroProposta = $dataSet[22];
		$me->codBarraProposta = $dataSet[23];
		$me->linhaDigitavelProposta = $dataSet[24];
		$me->valorParcela = $dataSet[25];
		$me->dtVencimentoParcela = date_banco($dataSet[26]);
		$me->numeroParcela = $dataSet[27];
		$me->codBarraParcela = $dataSet[28];
		$me->linhaDigitavelParcela = $dataSet[29];

		return $me;
	}

	public static function crm(array $dataSet)
	{
		$me = new static;
		$me->cpf = $dataSet[0];
		$me->idContrato = $dataSet[1];
		$me->idEmpresa = $dataSet[2];
		$me->idCarteira = $dataSet[3];
		$me->tpBoleto = $dataSet[4];

		return $me;
	}

	public static function sms(array $dataSet)
	{
        if(count($dataSet) > 1){
			$me = new static;
			$me->ddd = str_replace_accents($dataSet[0]);
			$me->telefone = str_replace_accents($dataSet[1]);
			$me->variavel_1 = str_replace_accents($dataSet[2]);

			$me->variavel_2 = str_null($dataSet[3]);
			$me->variavel_3 = str_null($dataSet[4]);
			$me->variavel_4 = str_null($dataSet[5]);

			return $me;
		}
	}

	public static function marketing(array $dataSet)
	{
        if(count($dataSet) > 1){

			$me = new static;
			$me->email = str_replace_accents($dataSet[0]);
			$me->variavel1 = str_replace_accents($dataSet[1]);
			$me->variavel2 = str_null($dataSet[2]);
			$me->variavel3 = str_null($dataSet[3]);
			$me->variavel4 = str_null($dataSet[4]);

			$validator = Validator::make((array) $me, [
				'email' => 'required|email',
				'variavel1' => 'required|string',
				'variavel2' => 'string|nullable',
				'variavel3' => 'string|nullable',
				'variavel4' => 'string|nullable',
			]);

			$me->valido = !$validator->fails();
			$me->falhas = $validator->failed();

			return $me;
		}
	}
}