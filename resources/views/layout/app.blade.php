<!DOCTYPE html>
<html lang="pt-BR">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Sistema de Gerenciamento de Ordem de serviço">
  <meta name="author" content="Ryan Freitas">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel = "shortcut icon" type = "imagem/x-icon" href = "icone.ico"/>


  <title>@yield('title')</title>
    @yield('head')
  
    <!-- Custom fonts for this template-->
    <link href="template/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="template/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
  
    <!-- Page level plugin CSS-->
    <link href="template/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  
    <!-- Custom styles for this template-->
    <link href="css/css/sb-admin.css" rel="stylesheet">

    

</head>

<body id="page-top">
    

  <nav class="navbar navbar-expand navbar-dark bg-primary static-top">

    <a class="navbar-brand mr-1" href="/"><strong>SGOS</strong> - System</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @yield('name')<i class="fas fa-user-circle"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Sair') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav bg-dark">
      <li class="nav-item">
        <a class="nav-link" href="/home">
          <i class="oi oi-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="oi oi-grid-two-up"></i>
          <span id="side">Auxiliares</span>
        </a>
        <div class="dropdown-menu" id="side" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" id="side" href="/equipes">Equipes</a>
          <a class="dropdown-item" id="side" href="/prioridades">Prioridades</a>
          <a class="dropdown-item" id="side" href="/status">Status</a>
          <a class="dropdown-item" id="side" href="/clientes">Clientes</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-tags"></i>
          <span id="side">Ordens de Serviço</span>
        </a>
        <div class="dropdown-menu" id="side" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" id="side" href="/tickets_aguardando">Não Atribuidas</a>
          <a class="dropdown-item" id="side" href="/meus_tickets">Atribuidas a mim</a>
          <a class="dropdown-item" id="side" href="/tickets_pendentes">Pendentes</a>
          <a class="dropdown-item" id="side" href="/tickets_concluidos">Concluidas</a>
          <a class="dropdown-item" id="side" href="/tickets_cancelados">Canceladas</a>
          <a class="dropdown-item" id="side" href="/tickets_pausados">Pausadas</a>
          <a class="dropdown-item" id="side" href="/tickets">Todas as Ordens</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="oi oi-person"></i>
          <span id="side">Controle de Usuário</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" id="side" href="/usuarios">Usuários</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/relatorio">
          <i class="fas fa-file-pdf"></i>
          <span>Relatórios</span>
        </a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Page Content -->
        @hasSection('body')
          @yield('body')
        @endif
        
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © SGOS - System 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <script src="template/jquery/jquery.min.js"></script>
  <script src="template/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="template/jquery-easing/jquery.easing.min.js"></script>


  <!-- Custom scripts for all pages-->
  <script src="js/js/sb-admin.min.js"></script>

  
  @hasSection('javascript')
    @yield('javascript')
  @endif

</body>

</html>
