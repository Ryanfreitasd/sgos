<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Client;
use App\User;
use Auth;
use PDF;
use Carbon\Carbon;

class PdfController extends Controller
{
    public function indexView()
    {
        return view('relatorio.index');
    }

    public function TodosTickets(Request $request)
    {
        // recebe a data e hora atual de acordo com a timezone
        $data_atual = Carbon::now('America/Sao_Paulo')->format('d/m/Y H:h');

        //recebe os valores do request dos inputs
        $dataInicial = $request->dataInicial;
        $dataFinal = $request->dataFinal;

        //formata as datas para exibir no relatorio
        $di = Carbon::createFromDate($dataInicial)->format('d/m/Y'); 
        $df = Carbon::createFromDate($dataFinal)->format('d/m/Y');

        //faz a busca no banco de dados
        $tic = Ticket::with(['client', 'priority'])
                    ->where('delivery_date','>=', $dataInicial)
                    ->where('delivery_date','<=', $dataFinal)
                    ->get();
        
        return PDF::loadView('relatorio_pdf.todasOrdens', compact('tic','data_atual', 'di', 'df'))
                    ->download('TodasOrdens.pdf');
    }

    public function OrdemConcluida(Request $request)
    {
        // recebe a data e hora atual de acordo com a timezone
        $data_atual = Carbon::now('America/Sao_Paulo')->format('d/m/Y H:h');

        //recebe os valores do request dos inputs
        $dataInicial = $request->dataInicial;
        $dataFinal = $request->dataFinal;

        //formata as datas para exibir no relatorio
        $di = Carbon::createFromDate($dataInicial)->format('d/m/Y'); 
        $df = Carbon::createFromDate($dataFinal)->format('d/m/Y');

        //faz a busca no banco de dados
        $tic = Ticket::with(['client', 'priority'])
                    ->where('status_id', '=', 4)
                    ->where('delivery_date','>=', $dataInicial)
                    ->where('delivery_date','<=', $dataFinal)
                    ->get();
        
        return PDF::loadView('relatorio_pdf.OrdemConcluida', compact('tic','data_atual', 'di', 'df'))
                    ->download('Ordens Concluidas.pdf');
    }

    public function OrdemCancelada(Request $request)
    {
        // recebe a data e hora atual de acordo com a timezone
        $data_atual = Carbon::now('America/Sao_Paulo')->format('d/m/Y H:h');

        //recebe os valores do request dos inputs
        $dataInicial = $request->dataInicial;
        $dataFinal = $request->dataFinal;

        //formata as datas para exibir no relatorio
        $di = Carbon::createFromDate($dataInicial)->format('d/m/Y'); 
        $df = Carbon::createFromDate($dataFinal)->format('d/m/Y');

        //faz a busca no banco de dados
        $tic = Ticket::with(['client', 'priority'])
                    ->where('status_id', '=', 5)
                    ->where('delivery_date','>=', $dataInicial)
                    ->where('delivery_date','<=', $dataFinal)
                    ->get();
        
        return PDF::loadView('relatorio_pdf.OrdemCancelada', compact('tic','data_atual', 'di', 'df'))
                    ->download('Ordens Canceladas.pdf');
    }

    public function OrdemPendente(Request $request)
    {
        // recebe a data e hora atual de acordo com a timezone
        $data_atual = Carbon::now('America/Sao_Paulo')->format('d/m/Y H:h');

        //recebe os valores do request dos inputs
        $dataInicial = $request->dataInicial;
        $dataFinal = $request->dataFinal;

        //formata as datas para exibir no relatorio
        $di = Carbon::createFromDate($dataInicial)->format('d/m/Y'); 
        $df = Carbon::createFromDate($dataFinal)->format('d/m/Y');

        //faz a busca no banco de dados
        $tic = Ticket::with(['client', 'priority'])
                    ->where('status_id', '=', 3)
                    ->where('delivery_date','>=', $dataInicial)
                    ->where('delivery_date','<=', $dataFinal)
                    ->get();
        
        return PDF::loadView('relatorio_pdf.OrdemPendente', compact('tic','data_atual', 'di', 'df'))
                    ->download('Ordens Pendentes.pdf');
    }

    public function OrdemPausada(Request $request)
    {
        // recebe a data e hora atual de acordo com a timezone
        $data_atual = Carbon::now('America/Sao_Paulo')->format('d/m/Y H:h');

        //recebe os valores do request dos inputs
        $dataInicial = $request->dataInicial;
        $dataFinal = $request->dataFinal;

        //formata as datas para exibir no relatorio
        $di = Carbon::createFromDate($dataInicial)->format('d/m/Y'); 
        $df = Carbon::createFromDate($dataFinal)->format('d/m/Y');

        //faz a busca no banco de dados
        $tic = Ticket::with(['client', 'priority'])
                    ->where('status_id', '=', 2)
                    ->where('delivery_date','>=', $dataInicial)
                    ->where('delivery_date','<=', $dataFinal)
                    ->get();
        
        return PDF::loadView('relatorio_pdf.OrdemPausada', compact('tic','data_atual', 'di', 'df'))
                    ->download('Ordens Pausadas.pdf');
    }

    public function OrdemAguardando(Request $request)
    {
        // recebe a data e hora atual de acordo com a timezone
        $data_atual = Carbon::now('America/Sao_Paulo')->format('d/m/Y H:h');

        //recebe os valores do request dos inputs
        $dataInicial = $request->dataInicial;
        $dataFinal = $request->dataFinal;

        //formata as datas para exibir no relatorio
        $di = Carbon::createFromDate($dataInicial)->format('d/m/Y'); 
        $df = Carbon::createFromDate($dataFinal)->format('d/m/Y');

        //faz a busca no banco de dados
        $tic = Ticket::with(['client', 'priority'])
                    ->where('status_id', '=', 1)
                    ->where('delivery_date','>=', $dataInicial)
                    ->where('delivery_date','<=', $dataFinal)
                    ->get();
        
        return PDF::loadView('relatorio_pdf.OrdemAguardando', compact('tic','data_atual', 'di', 'df'))
                    ->download('Ordens Aguardando.pdf');
    }

    public function MinhasOrdens(Request $request)
    {
        // recebe a data e hora atual de acordo com a timezone
        $data_atual = Carbon::now('America/Sao_Paulo')->format('d/m/Y H:h');

        //pega o usuario conectado
        $usuario = auth()->user()->name;
        

        //recebe os valores do request dos inputs
        $dataInicial = $request->dataInicial;
        $dataFinal = $request->dataFinal;

        //formata as datas para exibir no relatorio
        $di = Carbon::createFromDate($dataInicial)->format('d/m/Y'); 
        $df = Carbon::createFromDate($dataFinal)->format('d/m/Y');

        //faz a busca no banco de dados
            $tic = Ticket::with(['client', 'priority'])
                        ->where('user_id', '=', auth()->user()->id)
                        ->whereDate('delivery_date','>=', $dataInicial)
                        ->whereDate('delivery_date','<=', $dataFinal)
                        ->get();
            
            return PDF::loadView('relatorio_pdf.MinhasOrdens', compact('tic','data_atual', 'di', 'df', 'usuario'))
                        ->download('Atribuidos a mim.pdf');
    }

    public function Clientes(Request $request)
    {
        // recebe a data e hora atual de acordo com a timezone
        $data_atual = Carbon::now('America/Sao_Paulo')->format('d/m/Y H:h');

        //faz a busca no banco de dados
        $cli = Client::all();
        
        return PDF::loadView('relatorio_pdf.Clientes', compact('cli','data_atual'))
                    ->download('Clientes.pdf');
    }

}
