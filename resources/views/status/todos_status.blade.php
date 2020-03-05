@extends('layout.app')


@section('title', 'Status')

@section('breadcrumb_page','Todos os Status')


@section('body')
<div class="card mb-3">
<div class="card-header">
  <i class="fas fa-table"></i>
  Status </div>
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="tabelaStatus" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Codigo</th>
          <th>Descrição</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    <div class="card-footer">
        <button class="btn btn-primary btn-sm" onclick="setaStatus()" disabled>Novo Status</button>
    </div>
  </div>
</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgStatus">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formStatus">
                <div class="modal-header">
                    <div class="modal-title"><h4>Novo Status</h4></div>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" class="form-control">
                    <div class="form-group">
                        <label for="descricaoStatus" class="control-label">Descrição</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="descricaoStatus" placeholder="Digite aqui a descrição" required>
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

        $.ajaxSetup({ //TOKEN PARA PROCEDIMENTOS POST
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            }
        );

        function setaStatus(){ // ABRI O FORMULÁRIO COM TODOS OS CAMPOS SETADOS
            $('#id').val('');
            $('#descricaoStatus').val('');
            $('#dlgStatus').modal('show');
        }

        function montarLinha(c){ // CRIA SE A LINHA COM AS INFORMAÇÕES DO PRODUTO(SETADO) NA TABELA PRINCIPAL
          var linha = "<tr>" +
                      "<td>" + c.id + "</td>" +
                      "<td>" + c.name + "</td>" +
                      "<td>" + '<button class="btn btn-outline-primary btn-sm" onclick = "editar('+ c.id +')"> Ver/Editar </button>' + 
                               '<button class="btn btn-outline-danger btn-sm" onclick = "remover('+ c.id +')"> Apagar </button>' + "</td>" +
                      "</tr>";
                      return linha;
        }

        function carregarStatus(){ // CARREGA TODAS AS CATEGORIAS NA TABELA PRINCIPAL
            $.getJSON('/api/status', function(data){
                for(i = 0; i < data.length; i++){
                    linha = montarLinha(data[i]);
                    $('#tabelaStatus>tbody').append(linha);
                }
            });
        }

        function criarStatus() { // CRIA A CATEGORIA RECEBENDO AS INFORMAÇÕES DO FORMULARIO
            sta = { 
                name: $("#descricaoStatus").val()
                };

                $.post("/api/status", sta, function(data) {
                status = JSON.parse(data);
                linha = montarLinha(status);
                $('#tabelaStatus>tbody').append(linha);            
                });
        }

        function remover(id){ // REMOVER UM REGISTRO DA TABELA
            $.ajax({
                type: "DELETE",
                url:"/api/status/" + id,
                context: this,
                sucess: function(){
                    linhas = $("#tabelaStatus>tbody>tr"); //recebe todas as linhas da table products
                    e = linhas.filter(
                        function(i, elemento){
                            return (elemento.cells[0].textContent == id); // procura a linha que contenha o id 
                        });
                        if (e) // se nao for nulo ele remove
                            e.remove();
                            alert("Produto apagado com sucesso");
                },
                error: function(error){
                    console.log(error);
                }
            });
        }

        function salvarStatus(){ // SALVA AS INFORMAÇÕES DO REGISTRO CATEGORIA (EDITAR)
            sta = {
                id:     $("#id").val(),
                name:   $("#descricaoStatus").val()
            };
            $.ajax({
                type: "PUT",
                url:"/api/status/" + sta.id,
                data: sta,
                context: this,
                sucess: function(data){
                    sta.JSON.parse(data); //transforma elemento string em objeto
                    linhas = $("#tabelaStatus>tbody>tr"); // recebe todas as linhas da table
                    e = linhas.filter(
                        function(i, e){
                            return (e.cells[0].textContent == sta.id); // se o que tiver em e[0] for igual a prod[id]
                        }
                    );
                    if(e){ // recebe cada dado em cada celular da linha para os respectivos campos
                        e[0].cells[0].textContent = sta.id;
                        e[0].cells[1].textContent = sta.name;
                    }
                        
                },
                error: function(error){
                    console.log(error);
                }
            });
        }

        function editar(id){ //ABRI O FORMULÁRIO COM AS INFORMAÇÕES DO REGISTRO
            $.getJSON('/api/status/' + id, function(data){
                console.log(data);
                $("#id").val(data.id);
                $("#descricaoStatus").val(data.name);
                $("#dlgStatus").modal("show");

            });
        }
    
        $("#formStatus").submit( function(event){ //após apertar o botao, ele salvar ele faz uma verificação
            event.preventDefault(); 
            if ($("#id").val() != '')
                salvarStatus();
            else
                criarStatus();
                
            $("#dlgStatus").modal('hide');
        });
    
        $(function(){
            carregarStatus();
            
        });
    </script>
@endsection