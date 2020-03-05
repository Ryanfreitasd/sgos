<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Priority;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexView()
    {
        return view('priority.todas_prioridades');
    }
    public function index()
    {
        $pri = Priority::all();
        return $pri->toJson();
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
        $pri = new Priority();
        $pri->name = $request->input('name');
        $pri->time = $request->input('time');
        $pri->save();
        return json_encode($pri);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pri = Priority::find($id);                    // busca o registro que seja igual ao id
        if(isset($pri)){                               // faz a verificação se encontrou 
            return json_encode($pri);                  //retorna o registro através do json_encode
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
        $pri = Priority::find($id);                   // cat busca o registro que seja igual ao id
        if(isset($pri)){                              //verifica se encontrou o registro
            $pri->name = $request->input('name');
            $pri->time = $request->input('time');
            $pri->save();
            return response()->json($pri);
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
        $pri = Priority::find($id);                // cat busca o registro que seja igual ao id
        if(isset($pri))
            $pri->delete();
    }
}
