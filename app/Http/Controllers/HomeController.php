<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //variavel retornar a quantidade de tickets pendentes
        $data_atual = Carbon::now('America/Sao_Paulo')->format('d/m/Y H:h');
        $usuario = auth()->user()->name;
        $meuPendente = Ticket::select(DB::raw('count(*) as total'))
                ->where('user_id','=', auth()->user()->id)
                ->where('status_id',3)
                ->get();
        
        $meuPausado = Ticket::select(DB::raw('count(*) as total'))
                ->where('user_id','=', auth()->user()->id)
                ->where('status_id',2)
                ->get();
        
        $meuConcluido = Ticket::select(DB::raw('count(*) as total'))
                ->where('user_id','=', auth()->user()->id)
                ->where('status_id',4)
                ->get();
        $aguardando = Ticket::select(DB::raw('count(*) as total'))
                ->where('status_id', 1)
                ->get();

        $concluido = Ticket::select(DB::raw('count(*) as total'))
                        ->where('status_id', 4)
                        ->get();
   
        $cancelado = Ticket::select(DB::raw('count(*) as total'))
                ->where('status_id', 5)
                ->get();

        $pausado = Ticket::select(DB::raw('count(*) as total'))
                ->where('status_id', 2)
                ->get();

        $pendente = Ticket::select(DB::raw('count(*) as total'))
                ->where('status_id', 3)
                ->get();
        
        $jan = Ticket::select(DB::raw('count(*) as total'))
                ->where('delivery_date', '>=', '2019/01/01')
                ->where('delivery_date', '<=', '2019/01/31')
                ->get();
        
        $fev = Ticket::select(DB::raw('count(*) as total'))
                ->where('delivery_date', '>=', '2019/02/01')
                ->where('delivery_date', '<=', '2019/02/28')
                ->get(); 

        $mar = Ticket::select(DB::raw('count(*) as total'))
                ->where('delivery_date', '>=', '2019/03/01')
                ->where('delivery_date', '<=', '2019/03/30')
                ->get(); 

        $abr = Ticket::select(DB::raw('count(*) as total'))
                ->where('delivery_date', '>=', '2019/04/01')
                ->where('delivery_date', '<=', '2019/04/30')
                ->get();     

        $mai = Ticket::select(DB::raw('count(*) as total'))
                ->where('delivery_date', '>=', '2019/05/01')
                ->where('delivery_date', '<=', '2019/05/31')
                ->get();
        
        $jun = Ticket::select(DB::raw('count(*) as total'))
                ->where('delivery_date', '>=', '2019/06/01')
                ->where('delivery_date', '<=', '2019/06/29')
                ->get();
        
        $jul = Ticket::select(DB::raw('count(*) as total'))
                ->where('delivery_date', '>=', '2019/07/01')
                ->where('delivery_date', '<=', '2019/07/31')
                ->get(); 
        
        $ago = Ticket::select(DB::raw('count(*) as total'))
                ->where('delivery_date', '>=', '2019/08/01')
                ->where('delivery_date', '<=', '2019/08/31')
                ->get();     

        $set = Ticket::select(DB::raw('count(*) as total'))
                ->where('delivery_date', '>=', '2019/09/01')
                ->where('delivery_date', '<=', '2019/09/30')
                ->get();  
        
        $out = Ticket::select(DB::raw('count(*) as total'))
                ->where('delivery_date', '>=', '2019/10/01')
                ->where('delivery_date', '<=', '2019/10/31')
                ->get();   
        
        $nov = Ticket::select(DB::raw('count(*) as total'))
                ->where('delivery_date', '>=', '2019/11/01')
                ->where('delivery_date', '<=', '2019/11/30')
                ->get();
        
        $dez = Ticket::select(DB::raw('count(*) as total'))
                ->where('delivery_date', '>=', '2019/12/01')
                ->where('delivery_date', '<=', '2019/12/31')
                ->get();

        return view('index',compact('jan','fev','mar','abr','mai',
                'jun','jul','ago','set','out','nov','dez','usuario',
                'aguardando','concluido', 'cancelado', 'pausado','pendente',
                'meuPendente','meuPausado','meuConcluido','data_atual'));
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
