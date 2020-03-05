@extends('layout.app')

@section('title', 'Produtos')

@section('breadcrumb_title','Produtos')

@section('breadcrumb_page','Todos os Produtos')


@section('body')
<div class="card mb-3">
<div class="card-header">
  <i class="fas fa-table"></i>
  Produtos </div>
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="tabelaProduto" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Codigo</th>
          <th>Descrição</th>
          <th>Quantidade</th>
          <th>Preço Venda</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    <div class="card-footer">
        <button class="btn btn-primary btn-sm" onclick="setaProduto()">Novo Produto</button>
    </div>
  </div>
</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgProduto">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formProduto">
                <div class="modal-header">
                    <div class="modal-title"><h4>Novo Produto</h4></div>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" class="form-control">
                    <div class="form-group">
                        <label for="descricaoProduto" class="control-label">Descrição</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="descricaoProduto" placeholder="Digite aqui a descrição">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quantidadeProduto" class="control-label">Quantidade</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="quantidadeProduto">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="preco_custoProduto" class="control-label">Preço Custo</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="preco_custoProduto"  placeholder="00,00">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="preco_vendaProduto" class="control-label">Preço Venda</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="preco_vendaProduto"  placeholder="00,00">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoriaProduto" class="control-label">Categoria</label>
                        <div class="input-group">
                            <select class="form-control" id="categoriaProduto">
                            </select>
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

        function salvarProduto() { // salva o produto
            prod = { 
                id:             $("#id").val(),
                name:           $("#descricaoProduto").val(), 
                price_cost:     $("#preco_custoProduto").val(),
                price_sale:     $("#preco_vendaProduto").val(),  
                amount:         $("#quantidadeProduto").val(), 
                category_id:    $("#categoriaProduto").val()
            };
            $.ajax({
                type: "PUT",
                url:"/api/produtos/" + prod.id,
                data: prod,
                context: this,
                sucess: function(data){
                    prod.JSON.parse(data); //transforma elemento string em objeto
                    linhas = $("#tabelaProduto>tbody>tr"); // recebe todas as linhas da table
                    e = linhas.filter(
                        function(i, e){
                            return e.cells[0].textContent == prod.id; // se o que tiver em e[0] for igual a prod[id]
                        }
                    );
                    if(e){ // recebe cada dado em cada celular da linha para os respectivos campos
                        e[0].cells[0].textContent = prod.id;
                        e[0].cells[1].textContent = prod.name;
                        e[0].cells[2].textContent = prod.amount;
                        e[0].cells[3].textContent = prod.price_cost;
                        e[0].cells[4].textContent = prod.price_sale;
                        e[0].cells[5].textContent = prod.category_id;
                    }
                        
                },
                error: function(error){
                    console.log(error);
                }
            });
        }
        
        function remover(id){ // REMOVER UM REGISTRO DA TABELA
            $.ajax({
                type: "DELETE",
                url:"/api/produtos/" + id,
                context: this,
                sucess: function(){
                    linhas = $("#tabelaProduto>tbody>tr"); //recebe todas as linhas da table products
                    e = linhas.filter(
                        function(i, elemento){
                            return elemento.cells[0].textContent == id; // procura a linha que contenha o id 
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
        
        function setaProduto(){ // ABRI O FORMULÁRIO COM TODOS OS CAMPOS SETADOS
            $('#id').val('');
            $('#descricaoProduto').val('');
            $('#quantidadeProduto').val('');
            $('#preco_custoProduto').val('');
            $('#preco_vendaProduto').val('');
            $('#dlgProduto').modal('show');
        }

        function carregarCategoria(){ // CARREGA TODOS OS REGISTROS DA TABELA CATEGORIA NO CAMPO 
            $.getJSON('/api/categorias', function(data){
                for(i = 0; i < data.length; i ++){
                    opcao = '<option value= "' + data[i].id + '">' + data[i].name + '</option>';
                    $('#categoriaProduto').append(opcao);
                    }
                });
        }

        function montarLinha(p){ // CRIA SE A LINHA COM AS INFORMAÇÕES DO PRODUTO(SETADO) NA TABELA PRINCIPAL
          var linha = "<tr>" +
                      "<td>" + p.id + "</td>" +
                      "<td>" + p.name + "</td>" +
                      "<td>" + p.price_sale + "</td>" +
                      "<td>" + p.amount + "</td>" +
                      "<td>" + '<button class="btn btn-outline-primary btn-sm" onclick = "editar(' + p.id +')"> Ver/Editar </button>' + 
                               '<button class="btn btn-outline-danger btn-sm" onclick = "remover( '+ p.id + ')"> Apagar </button>' + "</td>" +
                      "</tr>";
                      return linha;
        }

                
        function carregarProduto(){ // CARREGA AS INFORMAÇÕES NA TABELA PRINCIPAL
          $.getJSON('/api/produtos', function(produto){
              for(i = 0; i < produto.length; i++){
                  linha = montarLinha(produto[i]);
                  $('#tabelaProduto>tbody').append(linha);
                }
            });
        }

        function criarProduto() { // CRIA O PRODUTO RECEBENDO AS INFORMAÇÕES DO FORMULARIO
            prod = { 
                name:           $("#descricaoProduto").val(), 
                price_cost:     $("#preco_custoProduto").val(),
                price_sale:     $("#preco_vendaProduto").val(),  
                amount:         $("#quantidadeProduto").val(), 
                category_id:    $("#categoriaProduto").val()
            };
            $.post("/api/produtos", prod, function(data) {
                produto = JSON.parse(data);
                linha = montarLinha(produto);
                $('#tabelaProduto>tbody').append(linha);            
            });
        }
        
     //ABRI O FORMULÁRIO PARA EDITAR AS INFORMAÇÕES   
        function editar(id){ 
            $.getJSON('/api/produtos/'+ id, function(data){
                console.log(data);
                $('#id').val(data.id);
                $('#descricaoProduto').val(data.name);
                $('#quantidadeProduto').val(data.amount);
                $('#preco_custoProduto').val(data.price_cost);
                $('#preco_vendaProduto').val(data.price_sale);
                $('#categoriaProduto').val(data.category_id);
                $('#dlgProduto').modal('show');
            });
        }
    
        $("#formProduto").submit( function(event){ //após apertar o botao, ele salvar ele faz uma verificação
            event.preventDefault(); 
            if ($("#id").val() != '')
                salvarProduto();
            else
                criarProduto();
                
            $("#dlgProduto").modal('hide');
        });
    
        $(function(){
            carregarCategoria();
            carregarProduto();
        });
    </script>
@endsection