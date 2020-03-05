@extends('layout.app')
@section('title', 'Página Principal')

@section('name')
  <strong>{{ $usuario }}</strong>
@endsection

@section('head')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
@endsection

@section('body')
<h5>Seja bem vindo, {{ $usuario }}!!</h5> 

<div id="content-wrapper">

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-plus-circle"></i>
                  </div>
                  <div class="mr-5">{{ $aguardando[0]->total }} Novas Ordens!</div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5">{{ $meuPendente[0]->total }} Ordens pausadas!</div>
                </div>
                  <span class="float-right">
                  </span>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-check-circle"></i>
                  </div>
                  <div class="mr-5">{{ $meuConcluido[0]->total }} Ordens Concluidas!</div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-exclamation-circle"></i>
                  </div>
                  <div class="mr-5">{{ $meuPendente[0]->total }} Ordens Pendentes</div>
                </div>
                  <span class="float-right">
                  </span>
                </a>
              </div>
            </div>
          </div>

      <div class="row">
        <div class="col-lg-8">
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-bar"></i>
              Total de Ordens por mês</div>
            <div class="card-body">
              <canvas id="BARRA" width="100%" height="50"></canvas>
            </div>
            <div class="card-footer small text-muted">Atualizado as {{ $data_atual }}</div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-pie"></i>
              Ordens por Status</div>
            <div class="card-body">
              <canvas id="PIZZA" width="100%" height="100"></canvas>
            </div>
            <div class="card-footer small text-muted">Atualizado as {{ $data_atual }}</div>
          </div>
        </div>
      </div>

    </div>

@endsection

@section('javascript')
    <script>
        //variavel de exemplo
      var concluido = "{{ $concluido[0]->total }}";
      var cancelado = "{{ $cancelado[0]->total }}";
      var pendente = "{{ $pendente[0]->total }}";
      var pausado = "{{ $pausado[0]->total }}";
      var aguardando = "{{ $aguardando[0]->total }}";

        var meses = ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']; 

        var tic = ["{{ $jan[0]->total }}","{{ $fev[0]->total }}","{{ $mar[0]->total }}","{{ $abr[0]->total }}","{{ $mai[0]->total }}","{{ $jun[0]->total }}",
                  "{{ $jul[0]->total }}","{{ $ago[0]->total }}","{{ $set[0]->total }}","{{ $out[0]->total }}","{{ $nov[0]->total }}","{{ $dez[0]->total }}"];
        
        
        //GRAFICO DE BARRA
        var ctx = document.getElementById('BARRA').getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
            datasets: [{
              label: "Ordens",
              backgroundColor: "rgba(2,117,216,1)",
              borderColor: "rgba(2,117,216,1)",
              data: tic,
            }],
          },
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  min: 0,
                  max:50, 
                  maxTicksLimit: 10
                },
                gridLines: {
                  display: true
                }
              }],
            },
            legend: {
              display: false
            }
          }
        });

        
        
        //GRAFICO DE PIZZA
        var ctx = document.getElementById("PIZZA");
        var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ["Aguardando", "Cancelado", "Pausado", "Concluido", "Pendente"],
            datasets: [{
              data: [aguardando,cancelado,pausado,concluido,pendente],
              backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745', '#808080'],
            }],
          },
        });


    </script>
@endsection