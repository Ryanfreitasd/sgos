<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexView()
    {
        return view('user.todos_usuarios');
    }
    public function index()
    {
        $user = User::all();
        return $user->toJson();
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
        $user = new User;
        $user->name =       $request->input('name');
        $user->email =      $request->input('email');
        $user->password =   bcrypt($request->input('password'));
        $user->team_id =    $request->input('team_id');
        $user->save();
        return json_encode($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if(isset($user)){
            return json_encode($user);
        }
        return response('Usuário nao encontrado');
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
        $user = User::find($id);
        if (isset($user)) {
            $user->name =       $request->input('name');
            $user->email =      $request->input('email');
            $user->password =   $request->input('password');
            $user->team_id =    $request->input('team_id');
            $user->save();
            return json_encode($user);
        }
        return response("Usuario nao encontrado", 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id); // variavel esta recebendo da classe PRODUCT o registro gravado no $id
        if (isset($user)) { // se tiver encontrado um produto com esse id
            $user->delete(); // chama a função delete para o registro gravado em prods
            return response("OK, APAGADO", 200);
        }
        return response("Usuario nao encontrado", 404);
    }
}
