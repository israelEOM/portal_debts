<?php
namespace App\Http\Controllers\Portal;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Integration\Nectar\Nectar;
use App\Services\Ws\WsService;

class DebbugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ws = new WsService();
        $response = $ws->getDivida("02838521861");

        // $response = $ws->getDivida("47609014850");
        dd($response);

        // $response = $ws->getDivida("08561727748");
        // $response = $ws->getDivida("33571072871");
        // $response = $ws->getDivida("00054484766");
        // $response = $ws->getDivida("04536701133");

        // dd($response);
        // $this->nectar = new Nectar;
        // $this->nectar->token();
        // $this->nectar->setCgcpf("04536701133");

        // // $response = $this->nectar->dadosDevedor();
        // $response = $this->nectar->divida();

        // dd($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}