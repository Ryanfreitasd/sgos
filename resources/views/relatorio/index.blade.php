@extends('layout.app')

@section('body')
    <div class="card">
        <div class="card-header">
            <h2>Relatório</h2>
        </div>
        <div class="card-body">
            <div class="form-row">
                <h6 class="col-md-3 ml-auto">Título</h6><h6 class="col-md-3 ml-auto">Data Inicial</h6><h6 class="col-md-6 ml-auto">Data Final</h6>
            </div>
            <hr/>
            <h5 class="card-title">Ordens de Serviço</h5>
            <div class="form-group"> <!-- TODAS AS ORDENS -->
                <div class="form-row">
                    <label for="" class="col-sm-3 col-form-label">Todas as ordens</label>
                    <form class="form-inline" method="POST" action="/relatorio/todasOrdens">
                        @csrf
                        <div class="form-group mx-sm-3 md-2">
                            <input class="form-control" type="date" name="dataInicial" id="dataInicial">
                        </div>
                        <div class="form-group mx-sm-3 md-2">
                            <input class="form-control" type="date" name="dataFinal" id="dataFinal">
                        </div>
                        <button type="submit" class="btn btn-secondary">Submeter</button>                       
                    </form>
                </div>
            </div>
            <div class="form-group"> <!-- ORDENS CONCLUIDAS -->
                <div class="form-row">
                    <label for="" class="col-sm-3 col-form-label">Ordens Concluídas</label>
                    <form class="form-inline" method="POST" action="/relatorio/OrdemConcluida">
                        @csrf
                        <div class="form-group mx-sm-3 md-2">
                            <input class="form-control" type="date" name="dataInicial" id="dataInicial">
                        </div>
                        <div class="form-group mx-sm-3 md-2">
                            <input class="form-control" type="date" name="dataFinal" id="dataFinal">
                        </div>
                        <button type="submit" class="btn btn-secondary">Submeter</button>                       
                    </form>
                </div>
            </div>
            <div class="form-group"> <!-- ORDENS CANCELADAS -->
                <div class="form-row">
                    <label for="" class="col-sm-3 col-form-label">Ordens Canceladas</label>
                    <form class="form-inline" method="POST" action="/relatorio/OrdemCancelada">
                        @csrf
                        <div class="form-group mx-sm-3 md-2">
                             <input class="form-control" type="date" name="dataInicial" id="dataInicial">
                        </div>
                        <div class="form-group mx-sm-3 md-2">
                             <input class="form-control" type="date" name="dataFinal" id="dataFinal">
                        </div>
                        <button type="submit" class="btn btn-secondary">Submeter</button>                       
                    </form>
                </div>
            </div>
            <div class="form-group"> <!-- ORDENS PAUSADAS -->
                    <div class="form-row">
                        <label for="" class="col-sm-3 col-form-label">Ordens Pausadas</label>
                        <form class="form-inline" method="POST" action="/relatorio/OrdemPausada">
                            @csrf
                            <div class="form-group mx-sm-3 md-2">
                                <input class="form-control" type="date" name="dataInicial" id="dataInicial">
                            </div>
                            <div class="form-group mx-sm-3 md-2">
                                <input class="form-control" type="date" name="dataFinal" id="dataFinal">
                            </div>
                            <button type="submit" class="btn btn-secondary">Submeter</button>                       
                        </form>
                    </div>
            </div>
            <div class="form-group"> <!-- ORDENS PENDENTES -->
                <div class="form-row">
                    <label for="" class="col-sm-3 col-form-label">Ordens Pendentes</label>
                    <form class="form-inline" method="POST" action="/relatorio/OrdemPendente">
                         @csrf
                        <div class="form-group mx-sm-3 md-2">
                            <input class="form-control" type="date" name="dataInicial" id="dataInicial">
                        </div>
                        <div class="form-group mx-sm-3 md-2">
                            <input class="form-control" type="date" name="dataFinal" id="dataFinal">
                        </div>
                        <button type="submit" class="btn btn-secondary">Submeter</button>                       
                    </form>
                </div>
            </div>
            <div class="form-group"> <!-- ORDENS AGUARDANDO -->
                <div class="form-row">
                    <label for="" class="col-sm-3 col-form-label">Ordens Aguardando</label>
                    <form class="form-inline" method="POST" action="/relatorio/OrdemAguardando">
                        @csrf
                        <div class="form-group mx-sm-3 md-2">
                            <input class="form-control" type="date" name="dataInicial" id="dataInicial">
                        </div>
                        <div class="form-group mx-sm-3 md-2">
                            <input class="form-control" type="date" name="dataFinal" id="dataFinal">
                        </div>
                        <button type="submit" class="btn btn-secondary">Submeter</button>                       
                    </form>
                </div>
            </div>
            <div class="form-group"> <!-- MINHAS ORDENS -->
                <div class="form-row">
                    <label for="" class="col-sm-3 col-form-label">Atribuidas a mim</label>
                    <form class="form-inline" method="POST" action="/relatorio/MinhasOrdens">
                        @csrf
                        <div class="form-group mx-sm-3 md-2">
                            <input class="form-control" type="date" name="dataInicial" id="dataInicial">
                        </div>
                        <div class="form-group mx-sm-3 md-2">
                            <input class="form-control" type="date" name="dataFinal" id="dataFinal">
                        </div>
                        <button type="submit" class="btn btn-secondary">Submeter</button>                       
                    </form>
                </div>
            </div>
            <hr/>
            <h5 class="card-title">Clientes</h5>
            <div class="form-group"> <!-- TODAS OS CLIENTES -->
                <div class="form-row">
                    <label for="" class="col-sm-3 col-form-label">Todos os Clientes</label>
                    <form class="form-inline" method="POST" action="/relatorio/clientes">
                        @csrf
                        <div class="form-group mx-sm-3 md-2">
                            <input class="form-control" type="hidden" name="dataInicial" id="dataInicial" readonly>
                        </div>
                        <div class="form-group mx-sm-3 md-2">
                            <input class="form-control" type="hidden" name="dataFinal" id="dataFinal" readonly>
                        </div>
                        <button type="submit" class="btn btn-secondary">Submeter</button>                       
                    </form>
                </div>
            </div>  
        </div>
    </div>
@endsection

