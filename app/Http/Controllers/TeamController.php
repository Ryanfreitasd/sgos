<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function indexView(){
        return view('team.todas_equipes');      // RETORNA A VIEW PRINCIPAL
    }

    public function index()
    {
        $team = Team::all();                    //ATRIBUI A VARIAVEL TODOS OS REGISTROS DE TEAM
        return $team->toJson();                 //RETORNA VIA JSON
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
        $team = new Team();                            //CRIA UMA NOVA INSTANCIA 
        $team->name = $request->input('name');         // SALVA NO CAMPO NAME O DADO INSERIDO DO FORM
        $team->save();                                 //SALVA
        return json_encode($team);                     //RETORNA
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::find($id);                        //ATRIBUI A VARIAVEL O REGISTRO PASSADO POR ID
        if(isset($team)){                               // FAZ A VERIFICAÇÃO SE A VARIAVEL TA VAZIA
            return json_encode($team);                  //RETORNA
        }
        return response("ERRO, registro não encontrado", 404);
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
        $team = Team::find($id);                    //ATRIBUI A VARIAVEL O REGISTRO PASSADO POR ID
        if(isset($team)){                           // FAZ A VERIFICAÇÃO SE A VARIAVEL TA VAZIA
            $team->name = $request->input('name');  // SALVA NO CAMPO NAME O DADO INSERIDO DO FORM
            $team->save();                          //SALVA
            return json_encode($team);              //RETORNA
        }
        return response("ERRO, registro não encontrado", 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::find($id);                    //ATRIBUI A VARIAVEL O REGISTRO PASSADO POR ID
        if(isset($team)){                           // FAZ A VERIFICAÇÃO SE A VARIAVEL TA VAZIA
            $team->delete();                        //DELETA
        }
    }
}
