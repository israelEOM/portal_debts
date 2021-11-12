<?php
namespace App\Services\Ws;


use App\Services\BaseService;
use App\Services\Integration\Nectar\Nectar;
use App\Services\Cliente\ClienteService;
use App\Services\Contrato\ContratoService;
use App\Services\Acesso\AcessoService;
use App\Services\Ws\Traits\{
	Divida,
	Negociacao,
	GravaNegociacao,
	Boleto,
	RegraDivida,
	RegraAcordo,
	RegraPromessa,
	RegraProposta,
	RegraGeral,
	Devedor
};
use stdclass;
use App\Repositories\Empresa\EmpresaRepository;

/**
 *
 */
class WsService extends BaseService
{
	use Divida, Negociacao, GravaNegociacao, Boleto, RegraDivida, RegraAcordo, RegraPromessa, RegraProposta, RegraGeral, Devedor;

	private $nectar;
	private $cliente;
	private $acesso;
	private $negociados;
	private $pendentes;
	private $response;

	public function __construct()
	{
		$this->cliente = new ClienteService();
		$this->acesso = new AcessoService();
		$this->nectar = new Nectar();

		$this->pendentes = collect();
		$this->negociados = collect();

		$this->response = new stdclass();
		$this->response->status = false;

        $this->data = now()->startOfDay();

        $this->empresa = new EmpresaRepository();
	}

	public function store(array $dataSet, $validate = false)
	{
        $this->cliente->store($dataSet);

        $this->acesso->store(["idCliente" => $this->cliente->getId(), "cpf" => $this->cliente->getCpf()]);
	}

	private function create($dataSet)
	{
	}

	public function update($id, array $dataSet)
	{
	}

	public function getDivida($cpf)
	{
        $this->store(["cgcpf" => $cpf]);

        $this->nectar->token();
		$this->nectar->setCgcpf($cpf);

		$this->divida($this->nectar->divida());

		if($this->response->status){
			$this->devedor($this->nectar->dadosDevedor());
		}

       	return $this->response;
	}

	public function getNegociacoes()
	{
		if($this->contrato->stPromessa || $this->contrato->stProposta)
			return false;

		$contratoService = new ContratoService();
		$contratoService->store(["idCrm" => $this->contrato->idContrato,
    		"idServidor" => $this->contrato->idServidor,
    		"idEmpresa" => $this->empresa->id,
    		"idCliente" => $this->cliente->getId()
    	]);

		$this->acesso->acessoContrato($contratoService->getId());

 		$this->nectar->setCgcpf($this->cliente->getCpf());
        $this->nectar->setIdServidor($this->contrato->idServidor);
        $this->nectar->setIdContrato($this->contrato->idContrato);
        $this->nectar->setTpNegociacao($this->contrato->tpNegociacao);
        $this->nectar->setTitulo($this->contrato->dividas);
        $this->nectar->setDtVencimento($this->contrato->dtVencimento);

        $this->nectar->token();

        $this->negociacao($this->nectar->getNegociacao());

       	return $this->response;
	}

	public function negociar($dataSet)
	{
		$dataSet = json_decode(json_encode($dataSet));

		$this->response->acesso = $dataSet->acesso;
		$this->response->contrato = $dataSet->contrato;
    	$this->negociacao = $dataSet->contrato;

    	$this->acesso->findById($dataSet->acesso->id);
    	$this->acesso->setIdAcessoContrato($dataSet->acesso->idAcessoContrato);
    	$this->acesso->setIdContrato($dataSet->acesso->idContrato);
        $this->acesso->acessoNegociacao($dataSet->parcela->codigo, $dataSet->parcela->faixa);

        $this->nectar->setCgcpf($dataSet->cliente->cgcpf);
	    $this->nectar->setIdServidor($this->negociacao->idServidor);
        $this->nectar->setIdContrato($this->negociacao->idContrato);
        $this->nectar->setTitulo($this->negociacao->dividas);
        $this->nectar->setDtVencimento($this->negociacao->dtVencimento);
        $this->nectar->setTpNegociacao($this->negociacao->tpNegociacao);
        $this->nectar->setDsPrincipal($dataSet->parcela->descontoPrincipal);
        $this->nectar->setDsCorrecao($dataSet->parcela->descontoCorrecao);
        $this->nectar->setPlano($dataSet->parcela->plano);
        $this->nectar->setCodigoFaixa($dataSet->parcela->codigo);
        $this->nectar->setDescricaoFaixa($dataSet->parcela->faixa);
        $this->nectar->setVlEntrada($dataSet->parcela->vlEntrada);
        $this->nectar->setVlDemais($dataSet->parcela->vlDemais);
        $this->nectar->setVlOriginal($dataSet->parcela->vlOriginal);
        $this->nectar->setVlCorrigido($dataSet->parcela->vlCorrigido);
        $this->nectar->setVlNegociar($dataSet->parcela->vlNegociar);
        $this->nectar->setQtParcela($dataSet->parcela->qtParcela);

        $this->nectar->token();
        $this->nectar->getEspecie();

        $this->gravaNegociacao($this->nectar->gravaNegociacao(), $dataSet->parcela);

		$this->response->cliente = $dataSet->cliente;

        return $this->response;
	}

	public function getBoleto($dataSet)
	{
		$dataSet =json_decode(json_encode($dataSet));

    	$this->acesso->findById($dataSet->idAcesso);

		$contratoService = new ContratoService();
		$contratoService->store(["idCrm" => $dataSet->idContrato,
    		"idServidor" => $dataSet->idServidor,
    		"idEmpresa" => $dataSet->idEmpresa,
    		"idCliente" => $dataSet->idCliente
    	]);

		$this->acesso->acessoContrato($contratoService->getId());
		$this->acesso->acessoBoletoFatura($dataSet);

        $this->nectar->setIdContrato($dataSet->idContrato);
	    $this->nectar->setIdServidor($dataSet->idServidor);
		$this->nectar->setTpBoleto($dataSet->tpNegociacao);
        $this->nectar->setIdBoleto($dataSet->boleto->id);

        $this->response->boleto = $dataSet->boleto;

        $this->nectar->token();
        $this->boleto($this->nectar->boleto());

       	return $this->response;
	}

	public function atualizarDados($dataSet)
	{
		$dataSet = json_decode(json_encode($dataSet));

        $this->nectar->setCgcpf($dataSet->cliente->cgcpf);
        $this->nectar->registrarEmail($dataSet->email);
        $this->nectar->registrarTelefone($dataSet->telefone);

        return ["msg" => "Dados atualizados com sucesso", "status" => true];
	}
}