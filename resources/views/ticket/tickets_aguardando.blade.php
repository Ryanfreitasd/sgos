@extends('layout.app')

@section('title', 'Ordens não Atribuidas')


@section('body')

<div class="card mb-3">
<div class="card-header">
        <i class="fas fa-table"></i><strong> ORDENS DE SERVIÇO NÃO ATRIBUIDAS </strong></div>
</div>
<div class="card-body">
  <div class="table-responsive">

        <table class="table table-bordered table-striped" id="tabelaTicket">
                <thead class="thread-dark"> <!-- add class="thead-light" for a light header -->
                  <tr>
                    <th>Codigo</th>
                    <th>Cliente</th>
                    <th>Descrição</th>
                    <th>Prioridade</th>
                    <th>Data Entrega</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
    <div class="card-footer">
       <button class="btn btn-primary btn-sm" onclick="setaTicket()">Nova ordem</button>
    </div>
  </div>
</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgTicket">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formTicket">
                <div class="modal-header">
                    <div class="modal-title"><h4>Nova Ordem de serviço</h4></div>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                          <label for="descricaoTicket" class="control-label">Título</label>
                          <input type="text" class="form-control" id="descricaoTicket" placeholder="Titulo do ticket">
                      </div>
                    </div>
                      <div class="form-row">
                          <div class="form-group col-md-6 ">
                              <label for="nomeClienteTicket" class="control-label">Nome cliente</label>
                              <select class="form-control" id="nomeClienteTicket" required></select>
                          </div>                        
                          <div class="form-group col-md-3 ">
                              <label for="numero" class="control-label">Número</label>
                              <input type="number" class="form-control"  id="id" readonly="true">
                          </div>
                          <div class="form-group col-md-3 ml-auto">
                            <label for="dataEntrega" class="control-label">Data Entrega</label>
                            <input type="date" class="form-control" id="dataEntrega" required>
                        </div> 
                      </div>
                      <div class="form-row">
                          <div class="form-group col-md-5 ">
                              <label for="usuarioTicket" class="control-label">Usuário</label>
                              <select class="form-control" id="usuarioTicket" selected="Sem Usuario" ></select>
                          </div> 
                          <div class="form-group col-md-4 ">
                              <label for="prioridadeTicket" class="control-label">Prioridade</label>
                              <select class="form-control" id="prioridadeTicket" required></select>
                          </div>           
                          <div class="form-group col-md-3 ">
                              <label for="statusTicket" class="control-label">Status</label>
                              <select class="form-control" id="statusTicket" required></select>
                          </div>
                      </div>  
                        <div class="form-group">
                          <label for="observacaoTicket" class="control-label">Conteúdo</label>
                        <div class="input-group">
                            <textarea class="form-control" id="observacaoTicket" rows="5" required></textarea>
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                    <button type="cancel" class="btn btn-danger btn-sm" data dismiss="modal">Cancelar</button>
            </div>  
            </form>
        </div>
    </div>
</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
@endsection

@section('javascript')
    <script type="text/javascript">

        $.ajaxSetup({headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            }
        );

        function salvarTicket() { // salva o ticket (editar)
            tic = { 
                id:                 $("#id").val(),
                description:        $("#descricaoTicket").val(),
                delivery_date:      $("#dataEntrega").val(),
                status_id:          $("#statusTicket").val(),  
                content:            $("#observacaoTicket").val(),
                user_id:            $("#usuarioTicket").val(),
                client_id:          $("#nomeClienteTicket").val(),
                priority_id:        $("#prioridadeTicket").val()

            };

            $.ajax({
                type: "PUT",
                url:"/api/tickets/" + tic.id,
                data: tic,
                context: this,
                sucess: function(data){
                    tic.JSON.parse(data); //transforma elemento string em objeto
                    linhas = $("#tabelaTicket>tbody>tr"); // recebe todas as linhas da table
                    e = linhas.filter(
                        function(i, e){
                            return e.cells[0].textContent == tic.id; // se o que tiver em e[0] for igual a prod[id]
                        }
                    );
                    if(e){ // recebe cada dado em cada celular da linha para os respectivos campos
                        e[0].cells[0].textContent = tic.id;
                        e[0].cells[2].textContent = tic.description;
                        e[0].cells[3].textContent = tic.status_id;
                        e[0].cells[4].textContent = tic.delivery_date;
                        e[0].cells[5].textContent = tic.content;
                        e[0].cells[6].textContent = tic.user_id;
                        e[0].cells[7].textContent = tic.client_id;
                        e[0].cells[8].textContent = tic.priority_id;
                    };
                },
                error: function(error){
                    console.log(error);
                    alert('Erro ao salvar ordem!');
                    document.location.reload(true);
                }
                
            });
            alert("Ordem salva com sucesso");
            document.location.reload(true);

        }
        
        function remover(id){ // REMOVER UM REGISTRO DA TABELA
            $.ajax({
                type: "DELETE",
                url:"/api/tickets/" + id,
                context: this,
                sucess: function(){
                    linhas = $("#tabelaTicket>tbody>tr"); //recebe todas as linhas da table products
                    e = linhas.filter(
                        function(i, elemento){
                            return elemento.cells[0].textContent == id; // procura a linha que contenha o id 
                        });
                        if (e) // se nao for nulo ele remove
                            e.remove();
                            alert("Ticket apagado com sucesso");
                },
                error: function(error){
                    console.log(error);
                    document.location.reload(true);
                    alert('ERRO');
                }
            });
            document.location.reload(true); 
            alert('Ordem apagada com sucesso!');
        }
        
        function setaTicket(){ // ABRI O FORMULÁRIO COM TODOS OS CAMPOS SETADOS
          $('#id').val('');
          $('#descricaoTicket').val('');
          $('#nomeClienteTicket').val('');
          $('#dataEntrega').val('');
          $('#usuarioTicket').val('');
          $('#prioridadeTicket').val('');
          $('#statusTicket').val('');
          $('#observacaoTicket').val('');
          $('#dlgTicket').modal('show');
        }

        function carregarCliente(){ // CARREGA TODOS OS REGISTROS DA TABELA CATEGORIA NO CAMPO 
            $.getJSON('/api/clientes', function(data){
                for(i = 0; i < data.length; i ++){
                    opcao = '<option value= "' + data[i].id + '">' + data[i].name + '</option>';
                    $('#nomeClienteTicket').append(opcao);
                    }
                });
        }

        function carregarUsuario(){ // CARREGA TODOS OS REGISTROS DA TABELA CATEGORIA NO CAMPO 
            $.getJSON('/api/usuarios', function(data){
                for(i = 0; i < data.length; i ++){
                    opcao = '<option value= "' + data[i].id + '">' + data[i].name + '</option>';
                    $('#usuarioTicket').append(opcao);
                    }
                });
        }

        function carregarStatus(){
            $.getJSON('/api/status', function(data){
                for(i=0; i<data.length; i++){
                    opcao = '<option value= "' + data[i].id + '">' + data[i].name + '</option>';
                    $('#statusTicket').append(opcao);
                }
            });
        }

        function carregarPrioridade(){
            $.getJSON('/api/prioridades', function(data){
                for(i=0; i<data.length; i++){
                    opcao = '<option value= "' + data[i].id + '">' + data[i].name + '</option>';
                    $('#prioridadeTicket').append(opcao);
                }
            });
        }

        function montarLinha(p){ // CRIA SE A LINHA COM AS INFORMAÇÕES DO PRODUTO(SETADO) NA TABELA PRINCIPAL
          var linha = "<tr>" +
                      "<td>" + p.id + "</td>" +
                      "<td>" + p.client.name + "</td>" +
                      "<td>" + p.description + "</td>" +
                      "<td>" + p.priority.name + "</td>" +
                      "<td>" + p.delivery_date + "</td>" +
                      "<td>" + p.status.name + "</td>" +
                      "<td>" + '<button class="btn btn-outline-primary btn-sm" onclick = "editar(' + p.id +')"> edit </button>' + 
                               '<button class="btn btn-outline-danger btn-sm" onclick = "remover( '+ p.id + ')"> del </button>' + "</td>" +
                      "</tr>";
                      return linha;
        }
        
        function carregarTicket(){ // CARREGA AS INFORMAÇÕES NA TABELA PRINCIPAL
          $.getJSON('/api/tickets_aguardando', function(ticket){
             for(i = 0; i < ticket.length; i++){
                  linha = montarLinha(ticket[i]);
                  $('#tabelaTicket>tbody').append(linha);
                }
            });
        }

        function criarTicket() { // CRIA O PRODUTO RECEBENDO AS INFORMAÇÕES DO FORMULARIO
            
            tic = { 
                description:        $("#descricaoTicket").val(),
                status_id:          $("#statusTicket").val(),  
                delivery_date:      $("#dataEntrega").val(), 
                content:            $("#observacaoTicket").val(),
                user_id:            $("#usuarioTicket").val(),
                client_id:          $("#nomeClienteTicket").val(),
                priority_id:        $("#prioridadeTicket").val()
            };
            $.post("/api/tickets_aguardando", tic, function(data) {
                ticket = JSON.parse(data);
                linha = montarLinha(ticket);
                $('#tabelaTicket>tbody').append(linha);
                       
            }); 
            document.location.reload(true);
            alert('Ordem criada com sucesso!');  
        }
       
     //ABRI O FORMULÁRIO PARA EDITAR AS INFORMAÇÕES   
        function editar(id){ 
            $.getJSON('/api/tickets/'+ id, function(data){
                console.log(data);
                $('#id').val(data.id);
                $('#descricaoTicket').val(data.description);
                $('#nomeClienteTicket').val(data.client_id);
                $('#dataEntrega').val(data.delivery_data);
                $('#usuarioTicket').val(data.user_id);
                $('#prioridadeTicket').val(data.priority_id);
                $('#statusTicket').val(data.status_id);
                $('#observacaoTicket').val(data.content);
                $('#dlgTicket').modal('show');
            });
        }


     
            
        $("#formTicket").submit( function(event){ //após apertar o botao, ele salvar ele faz uma verificação
            event.preventDefault(); 
            if ($("#id").val() != '')
                salvarTicket();
            else
                criarTicket();
                
            $("#dlgTicket").modal('hide');
        });
            
        $(function(){
            carregarCliente();
            carregarPrioridade();
            carregarUsuario();
            carregarStatus();
            carregarTicket();
            
        });


    </script>
@endsection