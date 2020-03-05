@extends('layout.app')


@section('title', 'Equipes')

@section('breadcrumb_page','Todos as Equipes')


@section('body')
<div class="card mb-3">
<div class="card-header">
  <i class="fas fa-table"></i>
  Equipes </div>
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="tabelaEquipe" width="100%" cellspacing="0">
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
        <button class="btn btn-primary btn-sm" onclick="setaEquipe()">Nova Equipe</button>
    </div>
  </div>
</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgEquipe">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formEquipe">
                <div class="modal-header">
                    <div class="modal-title"><h4>Nova Equipe</h4></div>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" class="form-control">
                    <div class="form-group">
                        <label for="descricaoEquipe" class="control-label">Descrição</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="descricaoEquipe" placeholder="Digite aqui a descrição" required>
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

        function setaEquipe(){ // ABRI O FORMULÁRIO COM TODOS OS CAMPOS SETADOS
            $('#id').val('');
            $('#descricaoEquipe').val('');
            $('#dlgEquipe').modal('show');
        } 
        
        function montarLinha(t){ // CRIA SE A LINHA COM AS INFORMAÇÕES DO PRODUTO(SETADO) NA TABELA PRINCIPAL
            var linha = "<tr>" +
                        "<td>" + t.id + "</td>" +
                        "<td>" + t.name + "</td>" +
                        "<td>" + '<button class="btn btn-outline-primary btn-sm" onclick = "editar('+ t.id +')"> Ver/Editar </button>' + 
                                 '<button class="btn btn-outline-danger btn-sm" onclick = "remover('+ t.id +')"> Apagar </button>' + "</td>" +
                        "</tr>";
                        return linha;
        }

        function carregarEquipe(){ // CARREGA TODAS AS CATEGORIAS NA TABELA PRINCIPAL
            $.getJSON('/api/equipes', function(equipe){
                for(i = 0; i < equipe.length; i++){
                    linha = montarLinha(equipe[i]);
                    $('#tabelaEquipe>tbody').append(linha);
                }
            });
        }
        function criarEquipe() { // CRIA A CATEGORIA RECEBENDO AS INFORMAÇÕES DO FORMULARIO
            equi = { 
                name: $("#descricaoEquipe").val()
                };

                $.post("/api/equipes", equi, function(data) {
                equipe = JSON.parse(data);
                linha = montarLinha(equipe);
                $('#tabelaEquipe>tbody').append(linha);
                document.location.reload(true);       
                alert('Equipe criada com sucesso!!'); 
            });
        }

        function remover(id){ // REMOVER UM REGISTRO DA TABELA
            $.ajax({
                type: "DELETE",
                url:"/api/equipes/" + id,
                context: this,
                sucess: function(){
                    linhas = $("#tabelaEquipe>tbody>tr"); //recebe todas as linhas da table products
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
            document.location.reload(true);
            alert("Equipe apagada com sucesso");
        }

        function salvarEquipe(){ // SALVA AS INFORMAÇÕES DO REGISTRO EQUIPE (EDITAR)
            equi = {
                id:     $("#id").val(),
                name:   $("#descricaoEquipe").val()
            };
            $.ajax({
                type: "PUT",
                url:"/api/equipes/" + equi.id,
                data: equi,
                context: this,
                sucess: function(data){
                    equi.JSON.parse(data); //transforma elemento string em objeto
                    linhas = $("#tabelaEquipe>tbody>tr"); // recebe todas as linhas da table
                    e = linhas.filter(
                        function(i, e){
                            return (e.cells[0].textContent == equi.id); // se o que tiver em e[0] for igual a prod[id]
                        }
                    );
                    if(e){ // recebe cada dado em cada celular da linha para os respectivos campos
                        e[0].cells[0].textContent = equi.id;
                        e[0].cells[1].textContent = equi.name;
                    }
                
                },
                error: function(error){
                    console.log(error);
                }
            });
            document.location.reload(true);
            alert('Equipe salva com sucesso!');
        }

        function editar(id){ //ABRI O FORMULÁRIO COM AS INFORMAÇÕES DO REGISTRO
            $.getJSON('/api/equipes/' + id, function(data){
                console.log(data);
                $("#id").val(data.id);
                $("#descricaoEquipe").val(data.name);
                $("#dlgEquipe").modal("show");

            });
        }
    
        $("#formEquipe").submit( function(event){ //após apertar o botao, ele salvar ele faz uma verificação
            event.preventDefault(); 
            if ($("#id").val() != '')
                salvarEquipe();
            else
                criarEquipe();
                
            $("#dlgEquipe").modal('hide');
        });
    
        $(function(){
            carregarEquipe();
            
        });



    </script>
@endsection