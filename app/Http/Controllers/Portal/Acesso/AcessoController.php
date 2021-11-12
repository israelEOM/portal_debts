<?php
namespace App\Http\Controllers\Portal\Acesso;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Acesso\AcessoService;
use App\Services\Contrato\ContratoService;


class AcessoController extends Controller
{
    private $acesso;

    public function __construct()
    {
        $this->acesso = new AcessoService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("errors.404");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("errors.404");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataSet = json_decode(json_encode($request->all()));

        $this->acesso->acessoBoleto($dataSet);

        return response()->json(["status" => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view("errors.404");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("errors.404");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataSet = json_decode(json_encode($request->all()));

        $contratoService = new ContratoService();
        $contratoService->store([
            "idCrm" => $dataSet->idCrm,
            "idServidor" => $dataSet->idServidor,
            "idEmpresa" => $dataSet->idEmpresa,
            "idCliente" => $dataSet->idCliente
        ]);

        $this->acesso->acessoContratoRiachuelo($dataSet->idAcesso, $contratoService->getId());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return view("errors.404");
    }
}