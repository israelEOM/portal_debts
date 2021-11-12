<?php
namespace App\Http\Controllers\Portal\Ws;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Ws\WsService;

class WsController extends Controller
{
    private $ws;

    public function __construct()
    {
        $this->ws = new WsService();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cpf = get_decrypt($request->cpf);

        $response = $this->ws->getDivida($cpf);

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getNegociacoes(Request $request)
    {
        $response = $this->ws->getNegociacoes($request->all());

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function negociar(Request $request)
    {
        $response = $this->ws->negociar($request->all());

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function boleto(Request $request)
    {
        $response = $this->ws->getBoleto($request->all());

        return response()->json($response);
    }
}