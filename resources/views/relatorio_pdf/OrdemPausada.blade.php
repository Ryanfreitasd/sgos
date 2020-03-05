@extends('layout.app3')

@section('head')
    <style>
        #titulo {
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
        }
        #tabela{
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }
        #lateral{
            text-align: right;
            font-style: italic;
        }
        #data{
            text-align: center;
            font-style: italic;
            font-size: 12px;
        }
    </style>
@endsection

@section('body')

<h3 id="titulo">Relatório - Ordens Pausadas</h3>
<p id="data">{{ $di }}  à  {{ $df }}</p>

<table class="table" style="width:100%" id="tabela">
        <tr>
            <th scope="col">Codigo</th>
            <th scope="col">Cliente</th>
            <th scope="col">Descrição</th>
            <th scope="col">Entrega</th>
            <th scope="col">Prioridade</th>
        </tr>
        
        <tbody>
            @foreach ($tic as $t )
            <tr>
                <td scope="row">{{ $t->id }}</td>
                <td scope="row">{{ $t->client->name }}</td>
                <td scope="row">{{ $t->description }}</td>
                <td scope="row">{{ $t->delivery_date }}</td>
                <td scope="row">{{ $t->priority->name }}</td>
            </tr>
            @endforeach
        </tbody>
        <hr/>
        <tr>
            <p id="lateral">Emitido em : <strong>{{ $data_atual }}</strong></p>
        </tr>
    </table>

@endsection