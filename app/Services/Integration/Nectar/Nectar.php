<?php
namespace App\Services\Integration\Nectar;


use SoapClient;
use stdClass;
use Exception;

class Nectar
{
    use WsToken, WsDadosDevedor, WsGetDivida, WsGetBoleto, WsAndamento, WsGetNegociacao, WsGravaNegociacao, WsGetEspecie, WsAtualizarContato;

    private $url = "http://172.20.0.47:8089";
    private $wsdl = "http://172.20.0.47:8089/Servicos/ServicoNectar.svc?wsdl";
    private $location = "http://172.20.0.47:8089/Servicos/ServicoNectar.svc";
	protected $client;
	protected $response;
	protected $parameters;

	public function __construct()
	{
		$this->client = new SoapClient($this->wsdl, [
			'location' => $this->location,
			'uri' => $this->url,
			'trace' => 1,
			"connection_timeout" => 30
		]);
	}

    public function setCgcpf($cnpjcpf)
    {
        $this->cnpjcpf = $cnpjcpf;
    }

	public function setIdServidor($idServidor)
	{
		$this->idServidor = $idServidor;
	}

    public function setIdContrato($idContrato)
    {
        $this->idContrato = $idContrato;
    }

	public function setCodigoParceiro($codigoParceiro)
	{
		$this->codigoParceiro = $codigoParceiro;
	}

	public function __destruct()
	{
		try{
			$this->client->close();
		}
		catch(Exception $e){
		}
	}
}