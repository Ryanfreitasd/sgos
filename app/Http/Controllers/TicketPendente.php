<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Priority;
use App\Status;
use App\User;
use Carbon\Carbon;

class TicketPendente extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexView()
    {
        return view('ticket.tickets_pendentes');
    }
    public function index()
    {
        $tic = Ticket::with(['priority', 'status', 'user', 'client'])->where('status_id', '=', 3)->orderByRaw('delivery_date ASC')->get();
        return response()->json($tic, 200);
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
        $dat = new Carbon();
        $pri = $request->input('priority_id');
            if($pri == 1){
                $dat = now()->addDays(5);
            }else if($pri == 2){
                $dat = now()->addDays(3);
            }else if($pri == 3){
                $dat = now()->addDays(2);
            }else if($pri == 4){
                $dat = now()->addDays(1);
            }

        $tic = new Ticket();
        $tic->description   = $request->input('description');
        $tic->status_id     = $request->input('status_id');
        $tic->content       = $request->input('content');
        $tic->user_id       = $request->input('user_id');
        $tic->client_id     = $request->input('client_id');
        $tic->priority_id   = $request->input('priority_id');
        $tic->delivery_date = $dat;
        $tic->save();

        return response()->json($tic);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $tic = Ticket::find($id);
        if(isset($tic)){
            return json_encode($tic);
        }
        return response('Ticket não encontrado', 404);
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
        $tic = Ticket::find($id);
        if(isset($tic)){

            $tic->description   = $request->input('description');
            $tic->status_id     = $request->input('status_id');
            $tic->content       = $request->input('content');
            $tic->user_id       = $request->input('user_id');
            $tic->client_id     = $request->input('client_id');
            $tic->priority_id   = $request->input('priority_id');
            $tic->delivery_date = $request->input('delivery_date');
            $tic->save();
            return json_encode($tic);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tic = Ticket::find($id);
        if(isset($tic)){
            $tic->delete();
        }
        return response('Ticket não encontrado', 404);
    }
}
