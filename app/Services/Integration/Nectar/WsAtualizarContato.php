<?php
namespace App\Services\Integration\Nectar;


use Exception;

trait WsAtualizarContato
{
    public function registrarEmail($email)
    {
        $this->parameters = [ "cnpjcpf" => trim($this->cnpjcpf),
            "email" => $email,
            "operacao" => null,
            "codigoParceiro" => $this->codigoParceiro,
            "codigoToken" => $this->codigoToken,
     	];

     	try{
        	$response = $this->client->RegistrarEmail($this->parameters);
        	return $response->RegistrarEmailResult;
     	}
     	catch(Exception $e){

     	}
    }

    public function registrarTelefone($telefone)
    {
        $ddd = substr($telefone, 0, 2);
        $numero = substr($telefone, 2, strlen($telefone));

        $this->parameters = ["cnpjcpf" => trim($this->cnpjcpf),
            "tipo" => (substr($numero, 0, 1) == 9) ? 2 : 1,
            "ddd" => $ddd,
            "numero" => $numero,
            "ramal" => null,
            "possuiwhatzapp" => null,
            "operacao" => null,
            "codigoParceiro" => $this->codigoParceiro,
            "codigoToken" => $this->codigoToken,
        ];

        try{
            $response = $this->client->RegistrarTelefone($this->parameters);
            return $response->RegistrarTelefoneResult;
        }
        catch(Exception $e){

        }
    }
}