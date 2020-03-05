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

<h3 id="titulo">Relatório - Todos os Clientes</h3>

<table class="table" style="width:100%" id="tabela">
        <tr>
            <th scope="col">Codigo</th>
            <th scope="col">Nome</th>
            <th scope="col">CPF</th>
            <th scope="col">Cidade</th>
            <th scope="col">Criação</th>
        </tr>
        
        <tbody>
            @foreach ($cli as $c )
            <tr>
                <td scope="row">{{ $c->id }}</td>
                <td scope="row">{{ $c->name }}</td>
                <td scope="row">{{ $c->cpf_cnpj }}</td>
                <td scope="row">{{ $c->city }}</td>
                <td scope="row">{{ $c->created_at->format('d/m/Y')}}</td>
            </tr>
            @endforeach
        </tbody>
        <hr/>
        <tr>
            <p id="lateral">Emitido em : <strong>{{ $data_atual }}</strong></p>
        </tr>
    </table>

@endsection