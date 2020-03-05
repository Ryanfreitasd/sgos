<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', function(){
    return view('auth.login');
});
   
    //ROTA DA PAGINA PRINCIPAL
    Route::get('/home', 'HomeController@index')->middleware('auth');
    
    //ROTA DE EQUIPES
    Route::get('/equipes', 'TeamController@indexView')->middleware('auth');
    
    //ROTA DE PRIORIDADES
    Route::get('/prioridades', 'PriorityController@indexView')->middleware('auth');
    
    //ROTA DE USUÁRIOS
    Route::get('/usuarios', 'UserController@indexView')->middleware('auth');
    
    //ROTA DE CLIENTES
    Route::get('/clientes', 'ClientController@indexView')->middleware('auth');
    
    //ROTA DE TICKETS
    Route::get('/tickets', 'TicketController@indexView')->middleware('auth');
    Route::get('/tickets_pendentes', 'TicketPendente@indexView')->middleware('auth');
    Route::get('/tickets_concluidos', 'TicketConcluido@indexView')->middleware('auth');
    Route::get('/tickets_aguardando', 'TicketAguardando@indexView')->middleware('auth');
    Route::get('/tickets_cancelados', 'TicketCancelado@indexView')->middleware('auth');
    Route::get('/tickets_pausados', 'TicketPausado@indexView')->middleware('auth');
    Route::get('/meus_tickets', 'MeusTicketsController@indexView')->middleware('auth');

    Route::get('/api/meus_tickets', 'MeusTicketsController@index')->middleware('auth');
    
    //ROTA DE STATUS
    Route::get('/status', 'StatusController@indexView')->middleware('auth');

    
    Route::get('/pdf','PdfController@TodosTickets');


    //grupo de rotas de relatório
    Route::prefix('relatorio')->group(function(){
        Route::get('/', 'PdfController@indexView')->middleware('auth');
        Route::post('todasOrdens','PdfController@TodosTickets')->middleware('auth');
        Route::post('OrdemConcluida','PdfController@OrdemConcluida')->middleware('auth');
        Route::post('OrdemCancelada','PdfController@OrdemCancelada')->middleware('auth');
        Route::post('OrdemPendente','PdfController@OrdemPendente')->middleware('auth');
        Route::post('OrdemPausada','PdfController@OrdemPausada')->middleware('auth');
        Route::post('OrdemAguardando','PdfController@OrdemAguardando')->middleware('auth');
        Route::post('MinhasOrdens','PdfController@MinhasOrdens')->middleware('auth');
        Route::post('clientes','PdfController@Clientes')->middleware('auth');
    });



