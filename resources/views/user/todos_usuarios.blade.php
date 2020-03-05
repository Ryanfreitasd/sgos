@extends('layout.app')
@section('title', 'Usuários')
@section('breadcrumb_page','Todos os Usuários')

@section('body')
<div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>
      Usuários </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="tabelaUsuario" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Codigo</th>
              <th>Nome</th>
              <th>Email</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        <div class="card-footer">
            <button class="btn btn-primary btn-sm" onclick="setaUsuario()">Novo Usuario</button>
        </div>
      </div>
    </div>
    </div>
    
    <div class="modal" tabindex="-1" role="dialog" id="dlgUsuario">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formUsuario">
                    <div class="modal-header">
                        <div class="modal-title"><h4>Novo Usuário</h4></div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">
                        <div class="form-row">
                                <div class="form-group col-sm-8">
                                    <label for="nomeUsuario" class="control-label">Nome</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="nomeUsuario" placeholder="Digite aqui o nome">
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                            <label for="emailUsuario" class="control-label">Email</label>
                            <div class="input-group">
                                <input type="email" class="form-control" id="emailUsuario" required>
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="senhaUsuario" class="control-label">Senha</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="senhaUsuario" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <label for="equipeUsuario" class="control-label">Equipe</label>
                                <div class="input-group">
                                    <select class="form-control" id="equipeUsuario" required>
                                    </select>
                                </div>
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

@section('javascript') //TOKEN PARA PROCEDIMENTOS POST
    <script type="text/javascript">

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            }
        );

        function salvarUsuario() { // salva o produto
            user = { 
                id:             $("#id").val(),
                name:           $("#nomeUsuario").val(), 
                email:          $("#emailUsuario").val(),
                password:       $("#senhaUsuario").val(), 
                team_id:        $("#equipeUsuario").val()
            };
            $.ajax({
                type: "PUT",
                url:"/api/usuarios/" + user.id,
                data: user,
                context: this,
                sucess: function(data){
                    user.JSON.parse(data); //transforma elemento string em objeto
                    linhas = $("#tabelaUsuario>tbody>tr"); // recebe todas as linhas da table
                    e = linhas.filter(
                        function(i, e){
                            return e.cells[0].textContent == user.id; // se o que tiver em e[0] for igual a prod[id]
                        }
                    );
                    if(e){ // recebe cada dado em cada celular da linha para os respectivos campos
                        e[0].cells[0].textContent = user.id;
                        e[0].cells[1].textContent = user.name;
                        e[0].cells[2].textContent = user.email;
                        e[0].cells[3].textContent = user.password;
                        e[0].cells[4].textContent = user.team_id;
                    }   
                },
                error: function(error){
                    console.log(error);
                }
            });
            document.location.reload(true);
            alert('Usuário salvo com sucesso');
        }
        
        function remover(id){ // REMOVER UM REGISTRO DA TABELA
            $.ajax({
                type: "DELETE",
                url:"/api/usuarios/" + id,
                context: this,
                sucess: function(){
                    linhas = $("#tabelaUsuario>tbody>tr"); //recebe todas as linhas da table products
                    e = linhas.filter(
                        function(i, elemento){
                            return elemento.cells[0].textContent == id; // procura a linha que contenha o id 
                        });
                        if (e) // se nao for nulo ele remove
                            e.remove();
                            alert("Usuario apagado com sucesso");
                },
                error: function(error){
                    console.log(error);
                }
            });
            document.location.reload(true);
            alert('Usuário removido com sucesso');
        }
        
        function setaUsuario(){ // ABRI O FORMULÁRIO COM TODOS OS CAMPOS SETADOS
            $('#id').val('');
            $('#nomeUsuario').val('');
            $('#emailUsuario').val('');
            $('#senhaUsuario').val('');
            $('#equipeUsuario').val('');
            $('#dlgUsuario').modal('show');
        }

        function carregarEquipe(){ // CARREGA TODOS OS REGISTROS DA TABELA CATEGORIA NO CAMPO 
            $.getJSON('/api/equipes', function(data){
                for(i = 0; i < data.length; i ++){
                    opcao = '<option value= "' + data[i].id + '">' + data[i].name + '</option>';
                    $('#equipeUsuario').append(opcao);
                    }
                });
        }


        function montarLinha(u){ // CRIA SE A LINHA COM AS INFORMAÇÕES DO PRODUTO(SETADO) NA TABELA PRINCIPAL
          var linha = "<tr>" +
                      "<td>" + u.id + "</td>" +
                      "<td>" + u.name + "</td>" +
                      "<td>" + u.email + "</td>" +
                      "<td>" + '<button class="btn btn-outline-primary btn-sm" onclick = "editar(' + u.id +')"> Ver/Editar </button>' + 
                               '<button class="btn btn-outline-danger btn-sm" onclick = "remover( '+ u.id + ')"> Apagar </button>' + "</td>" +
                      "</tr>";
                      return linha;
        }

                
        function carregarUsuario(){ // CARREGA AS INFORMAÇÕES NA TABELA PRINCIPAL
          $.getJSON('/api/usuarios', function(usuario){
              for(i = 0; i < usuario.length; i++){
                  linha = montarLinha(usuario[i]);
                  $('#tabelaUsuario>tbody').append(linha);
                }
            });
        }

        function criarUsuario() { // CRIA O PRODUTO RECEBENDO AS INFORMAÇÕES DO FORMULARIO 
            user = { 
                name:           $("#nomeUsuario").val(), 
                email:          $("#emailUsuario").val(),
                password:       $("#senhaUsuario").val(),
                team_id:        $("#equipeUsuario").val()
            };
            $.post("/api/usuarios", user, function(data) {
                usuario = JSON.parse(data);
                linha = montarLinha(usuario);
                $('#tabelaUsuario>tbody').append(linha);
                document.location.reload(true);
                alert('Usuário criado com sucesso');            
            });
        }
        
     //ABRI O FORMULÁRIO PARA EDITAR AS INFORMAÇÕES   
        function editar(id){ 
            $.getJSON('/api/usuarios/'+ id, function(data){
                console.log(data);
                $('#id').val(data.id);
                $('#nomeUsuario').val(data.name);
                $('#emailUsuario').val(data.email);
                $('#senhaUsuario').val(data.password);
                $('#equipeUsuario').val(data.team_id);
                $('#dlgUsuario').modal('show');
            });
        }

    
        $("#formUsuario").submit( function(event){ //após apertar o botao, ele salvar ele faz uma verificação
            event.preventDefault(); 
            if ($("#id").val() != '')
                salvarUsuario();
            else
                criarUsuario();
                
            $("#dlgUsuario").modal('hide');
        });

            
        $(function(){
            carregarEquipe();
            carregarUsuario();
        });
    </script>
@endsection