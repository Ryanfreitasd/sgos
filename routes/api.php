<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('/equipes', 'TeamController');                  //EQUIPE
Route::resource('/prioridades', 'PriorityController');          //PRIORIDADES
Route::resource('/usuarios', 'UserController');                 //USUARIO
Route::resource('/clientes','ClientController');                //CLIENTE
Route::resource('/tickets', 'TicketController');                //TICKET
Route::resource('/tickets_pendentes', 'TicketPendente');        //TICKET PENDENTE
Route::resource('/tickets_aguardando', 'TicketAguardando');     //TICKET AGUARDANDO
Route::resource('/tickets_concluidos', 'TicketConcluido');      //TICKET CONCLUIDO
Route::resource('/tickets_pausados', 'TicketPausado');          //TICKET PAUSADO
Route::resource('/tickets_cancelados', 'TicketCancelado');      //TICKET CANCELADO
Route::resource('/meus_tickets', 'MeusTicketsController')->middleware('auth')->except('index');      //MEUS TICKETS
Route::resource('/status', 'StatusController');                 //STATUS
Route::resource('/home', 'HomeController');                     //HOME