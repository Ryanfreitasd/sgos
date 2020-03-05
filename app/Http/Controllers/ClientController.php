<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexView(){
        return view('client.todos_clientes');
    }
    public function index()
    {
        $cli = Client::all();
        return $cli->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cli = new Client();
        $cli->name =            $request->input('name');
        $cli->cpf_cnpj =        $request->input('cpf_cnpj');
        $cli->birth =           $request->input('birth');
        $cli->public_place =    $request->input('public_place');
        $cli->number =          $request->input('number');
        $cli->complement =      $request->input('complement');
        $cli->neighborhood =    $request->input('neighborhood');
        $cli->cep =             $request->input('cep');
        $cli->city =            $request->input('city');
        $cli->state =           $request->input('state');
        $cli->save();
        return json_encode($cli);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cli =  Client::find($id);
        if(isset($cli)){
            return json_encode($cli);
        }
        return response("Cliente não encontrado!", 404);
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
        $cli = Client::find($id);
        if(isset($cli)) {  
            $cli->name =            $request->input('name');
            $cli->cpf_cnpj =        $request->input('cpf_cnpj');
            $cli->birth =           $request->input('birth');
            $cli->public_place =    $request->input('public_place');
            $cli->number =          $request->input('number');
            $cli->complement =      $request->input('complement');
            $cli->neighborhood =    $request->input('neighborhood');
            $cli->cep =             $request->input('cep');
            $cli->city =            $request->input('city');
            $cli->state =           $request->input('state');
            $cli->save();
            return json_encode($cli); 
        }
        return response("Cliente não encontrado", 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cli = Client::find($id);
        if(isset($cli)) {
            $cli ->delete();
            return response("Ok, cliente apagado com sucesso!", 200);
        }
        return response("Cliente não encontrado", 404);
    }
}
