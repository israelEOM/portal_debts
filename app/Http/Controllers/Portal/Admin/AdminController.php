<?php
namespace App\Http\Controllers\Portal\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateContactRequest;
use App\Services\Ws\WsService;

class AdminController extends Controller
{
    private $ws;

    public function __construct()
    {
        $this->ws = new WsService();
    }

    public function index()
    {
        return view("portal.admin.index");
    }

    public function getDivida(Request $request)
    {
        $data = $this->ws->getDivida($request->cpf);

        if (!$data->status)
            return response()->json(["error" => true, "value" => $data], 422);

        return response()->json($data);
    }

    public function storeNegociacao(Request $request)
    {
        $data = $this->ws->negociar($request->all());

        return response()->json($data);
    }

    public function downloadBoleto(Request $request)
    {
        $data = $this->ws->getBoleto($request->all());

        // return response()->json([
        //     'boleto' => 
        //     []
        // ]);
        return response()->json($data);
    }

    public function updateContato(UpdateContactRequest $request)
    {
        $data = $this->ws->atualizarDados($request->all());

        return response()->json($data);
    }
}