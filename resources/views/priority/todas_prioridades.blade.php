@extends('layout.app')
@section('title', 'Prioridades')
@section('breadcrumb_page','Todos as Prioridades')

@section('body')
<div class="card mb-3">
<div class="card-header">
  <i class="fas fa-table"></i>
  Prioridades </div>
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="tabelaPrioridade" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Codigo</th>
          <th>Descrição</th>
          <th>Tempo Vencimento</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    <div class="card-footer">
       <button class="btn btn-primary btn-sm" onclick="setaPrioridade()" disabled>Nova Prioridade</button>
    </div>
  </div>
</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgPrioridade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formPrioridade">
                <div class="modal-header">
                    <div class="modal-title"><h4>Nova Prioridade</h4></div>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" class="form-control">
                    <div class="form-group">
                        <label for="descricaoPrioridade" class="control-label">Descrição</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="descricaoPrioridade" placeholder="Digite aqui a descrição" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tempoPrioridade" class="control-label">Tempo de Vencimento</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="tempoPrioridade" placeholder="Digite aqui o tempo de vencimento" required>
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            }
        );

        function setaPrioridade(){ // ABRI O FORMULÁRIO COM TODOS OS CAMPOS SETADOS
            $('#id').val('');
            $('#descricaoPrioridade').val('');
            $('#tempoPrioridade').val('');
            $('#dlgPrioridade').modal('show');
        }

        function montarLinha(p){ // CRIA SE A LINHA COM AS INFORMAÇÕES DO PRODUTO(SETADO) NA TABELA PRINCIPAL
          var linha = "<tr>" +
                      "<td>" + p.id + "</td>" +
                      "<td>" + p.name + "</td>" +
                      "<td>" + p.time + "</td>" +
                      "<td>" + '<button class="btn btn-outline-primary btn-sm" onclick = "editar('+ p.id +')"> Ver/Editar </button>' + 
                               '<button class="btn btn-outline-danger btn-sm" onclick = "remover('+ p.id +')"> Apagar </button>' + "</td>" +
                      "</tr>";
                      return linha;
        }
        function carregarPrioridade(){ // CARREGA TODAS AS CATEGORIAS NA TABELA PRINCIPAL
          $.getJSON('/api/prioridades', function(prioridade){
              for(i = 0; i < prioridade.length; i++){
                  linha = montarLinha(prioridade[i]);
                  $('#tabelaPrioridade>tbody').append(linha);
              }
          });
        }

        function criarPrioridade() { // CRIA A CATEGORIA RECEBENDO AS INFORMAÇÕES DO FORMULARIO
            pri = { 
                name: $("#descricaoPrioridade").val(),
                time: $("#tempoPrioridade").val()
                };

                $.post("/api/prioridades", pri, function(data) {
                prioridade = JSON.parse(data);
                linha = montarLinha(prioridade);
                $('#tabelaPrioridade>tbody').append(linha);            
                });
        }

        function remover(id){ // REMOVER UM REGISTRO DA TABELA
            $.ajax({
                type: "DELETE",
                url:"/api/prioridades/" + id,
                context: this,
                sucess: function(){
                    linhas = $("#tabelaPrioridade>tbody>tr"); //recebe todas as linhas da table products
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

        function salvarPrioridade(){ // SALVA AS INFORMAÇÕES DO REGISTRO CATEGORIA (EDITAR)
            pri = {
                id:     $("#id").val(),
                name:   $("#descricaoPrioridade").val(),
                time:   $("#tempoPrioridade").val()
            };
            $.ajax({
                type: "PUT",
                url:"/api/prioridades/" + pri.id,
                data: pri,
                context: this,
                sucess: function(data){
                    pri.JSON.parse(data); //transforma elemento string em objeto
                    linhas = $("#tabelaPrioridade>tbody>tr"); // recebe todas as linhas da table
                    e = linhas.filter(
                        function(i, e){
                            return (e.cells[0].textContent == pri.id); // se o que tiver em e[0] for igual a prod[id]
                        }
                    );
                    if(e){ // recebe cada dado em cada celula da linha para os respectivos campos
                        e[0].cells[0].textContent = pri.id;
                        e[0].cells[1].textContent = pri.name;
                        e[0].cells[2].textContent = pri.time;
                    }
                        
                },
                error: function(error){
                    console.log(error);
                }
            });
        }

        function editar(id){ //ABRI O FORMULÁRIO COM AS INFORMAÇÕES DO REGISTRO
            $.getJSON('/api/prioridades/' + id, function(data){
                console.log(data);
                $("#id").val(data.id);
                $("#descricaoPrioridade").val(data.name);
                $("#tempoPrioridade").val(data.time);
                $("#dlgPrioridade").modal("show");

            });
        }
    
        $("#formPrioridade").submit( function(event){ //após apertar o botao, ele salvar ele faz uma verificação
            event.preventDefault(); 
            if ($("#id").val() != '')
                salvarPrioridade();
            else
                criarPrioridade();
                
            $("#dlgPrioridade").modal('hide');
        });
    
        $(function(){
            carregarPrioridade();
            
        });
    </script>
@endsection