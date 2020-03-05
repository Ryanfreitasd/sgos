@extends('layout.app')
@section('title', 'Clientes')
@section('breadcrumb_page','Todos os Clientes')

@section('head')
    <style>
        .valido {
            border: 2px solid green;
        }
        .invalido {
            border: 2px solid red;
        }
    </style>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    
    <!-- Funções para validação de CPF e CNPJ -->
    <script src="js/valida_cpf_cnpj.js"></script>
        
    <!-- Pressionando teclas -->
    <script src="js/exemplo_1.js"></script>
      
    
    <!-- Formatando o CPF ou CNPJ -->
    <script src="js/exemplo_3.js"></script>
@endsection

@section('body')
    <div class="card mb-3">
    <div class="card-header">
    <i class="fas fa-table"></i>
    Clientes </div>
    <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="tabelaCliente" width="100%" cellspacing="0">
        <thead>
            <tr>
            <th>Codigo</th>
            <th>Nome</th>
            <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
        <div class="card-footer">
            <button class="btn btn-primary btn-sm" onclick="setaCliente()">Novo Cliente</button>
        </div>
    </div>
    </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="dlgCliente" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formCliente">
                    <div class="modal-header">
                        <div class="modal-title"><h4>Novo Cliente</h4></div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">
                        <div class="form-row">
                            <div class="form-group col-md-5 ml-auto">
                                <label for="nomeCliente" class="control-label">Nome</label>
                                <input type="text" class="form-control" id="nomeCliente" placeholder="Digite aqui o nome do Cliente" required>
                            </div>                        
                            <div class="form-group col-md-4 ml-auto">
                                <label for="cpfcpnj" class="control-label">CPF/CNPJ</label>
                                <input  type="text" class="cpf_cnpj form-control"  id="cpfcpnj" required>
                            </div>
                            <div class="form-group col-md-3 ml-auto">
                                <label for="nascimentoCliente" class="control-label">Nascimento</label>
                                <input type="date" class="form-control" id="nascimentoCliente" required>
                            </div> 
                        </div> 
                        <div class="form-row">  
                            <div class="form-group col-md-3">
                                <label for="cepCliente" class="control-label">CEP</label>
                                <input type="text" class="form-control" id="cepCliente" required>
                            </div> 
                            <div class="form-group col-md-4 ml-auto">
                                <label for="complementoCliente" class="control-label">Complemento</label>
                                <input type="text" class="form-control" id="complementoCliente">
                            </div>           
                            <div class="form-group col-md-2 ml-auto">
                                <label for="numeroCasaCliente" class="control-label">Número</label>
                                <input type="number" class="form-control" id="numerocasaCliente">
                            </div>
                            <div class="form-group col-md-2 ml-auto">
                                <label for="estadoCliente" class="control-label">Estado</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="estadoCliente"><br>
                                </div>
                            </div>
                        </div>              
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="logradouroCliente" class="control-label">Logradouro</label>
                                <input type="text" class="form-control" id="logradouroCliente">
                            </div>
                            <div class="form-group col-md-4 ml-auto">
                                <label for="bairroCliente" class="control-label">Bairro</label>
                                <input type="text" class="form-control" id="bairroCliente">
                            </div>
                            <div class="form-group col-md-4 ml-auto">
                                <label for="cidadeCliente" class="control-label">Cidade</label>
                                <input type="text" class="form-control" id="cidadeCliente">
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

        function salvarCliente() { // salva o cliente
            cli = { 
                id:             $("#id").val(),
                name:           $("#nomeCliente").val(), 
                cpf_cnpj:       $("#cpfcpnj").val(),
                birth:          $("#nascimentoCliente").val(),  
                public_place:   $("#logradouroCliente").val(), 
                number:         $("#numerocasaCliente").val(),
                complement:     $("#complementoCliente").val(),
                neighborhood:   $("#bairroCliente").val(),
                cep:            $("#cepCliente").val(),
                city:           $("#cidadeCliente").val(),
                state:          $("#estadoCliente").val()
            };
            $.ajax({
                type: "PUT",
                url:"/api/clientes/" + cli.id,
                data: cli,
                context: this,
                sucess: function(data){
                    cli.JSON.parse(data); //transforma elemento string em objeto
                    linhas = $("#tabelaCliente>tbody>tr"); // recebe todas as linhas da table
                    e = linhas.filter(
                        function(i, e){
                            return e.cells[0].textContent == cli.id; // se o que tiver em e[0] for igual a cli[id]
                        }
                    );
                    if(e){ // recebe cada dado em cada celular da linha para os respectivos campos
                        e[0].cells[0].textContent = cli.id;
                        e[0].cells[1].textContent = cli.name;
                        e[0].cells[2].textContent = cli.cpf_cnpj;
                        e[0].cells[3].textContent = cli.birth;
                        e[0].cells[4].textContent = cli.public_place;
                        e[0].cells[5].textContent = cli.number;
                        e[0].cells[6].textContent = cli.complement;
                        e[0].cells[7].textContent = cli.neighborhood;
                        e[0].cells[8].textContent = cli.cep;
                        e[0].cells[9].textContent = cli.city;
                        e[0].cells[10].textContent = cli.state;
                    }
                        
                },
                error: function(error){
                    console.log(error);
                }
            });
            document.location.reload(true);
            alert('Cliente salvo com sucesso');
        }
        
        function remover(id){ // REMOVER UM REGISTRO DA TABELA
            $.ajax({
                type: "DELETE",
                url:"/api/clientes/" + id,
                context: this,
                sucess: function(){
                    linhas = $("#tabelaCliente>tbody>tr"); //recebe todas as linhas da table cliucts
                    e = linhas.filter(
                        function(i, elemento){
                            return elemento.cells[0].textContent == id; // procura a linha que contenha o id 
                        });
                        if (e) // se nao for nulo ele remove
                            e.remove();
                            alert("cliente apagado com sucesso");
                },
                error: function(error){
                    console.log(error);
                }
            });
            document.location.reload(true);
            alert('CLiente apagado com sucesso');
        }
        
        function setaCliente(){ // ABRI O FORMULÁRIO COM TODOS OS CAMPOS SETADOS
            $('#id').val('');
            $('#nomeCliente').val(''); 
            $('#cpfcpnj').val('');
            $('#nascimentoCliente').val('');
            $('#logradouroCliente').val(''); 
            $('#numerocasaCliente').val('');
            $('#complementoCliente').val('');
            $('#bairroCliente').val('');
            $('#cepCliente').val('');
            $('#cidadeCliente').val('');
            $('#estadoCliente').val('');
            $('#dlgCliente').modal('show');
        }

        //BUSCANDO ENDEREÇO PELO CEP
        $(document).ready(function() {

            
            //Quando o campo cep perde o foco.
            $("#cepCliente").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#logradouroCliente").val("...");
                        $("#bairroCliente").val("...");
                        $("#cidadeCliente").val("...");
                        $("#estadoCliente").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#logradouroCliente").val(dados.logradouro);
                                $("#bairroCliente").val(dados.bairro);
                                $("#cidadeCliente").val(dados.localidade);
                                $("#estadoCliente").val(dados.uf);
                                
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                //limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        //limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                   // limpa_formulário_cep();
                }
            });
        });
        
        function montarLinha(c){ // CRIA SE A LINHA COM AS INFORMAÇÕES DO cliUTO(SETADO) NA TABELA PRINCIPAL
        var linha = "<tr>" +
                    "<td>" + c.id + "</td>" +
                    "<td>" + c.name + "</td>" +
                    "<td>" + '<button class="btn btn-outline-primary btn-sm" onclick = "editar(' + c.id +')"> Ver/Editar </button>' + 
                            '<button class="btn btn-outline-danger btn-sm" onclick = "remover( '+ c.id + ')"> Apagar </button>' + "</td>" +
                    "</tr>";
                    return linha;
        }

                
        function carregarCliente(){ // CARREGA AS INFORMAÇÕES NA TABELA PRINCIPAL
        $.getJSON('/api/clientes', function(cliente){
            for(i = 0; i < cliente.length; i++){
                linha = montarLinha(cliente[i]);
                $('#tabelaCliente>tbody').append(linha);
                }
            });
        }

        function criarCliente() { // CRIA O cliUTO RECEBENDO AS INFORMAÇÕES DO FORMULARIO
            cli = { 
                id:             $("#id").val(),
                name:           $("#nomeCliente").val(), 
                cpf_cnpj:       $("#cpfcpnj").val(),
                birth:          $("#nascimentoCliente").val(),  
                public_place:   $("#logradouroCliente").val(), 
                number:         $("#numerocasaCliente").val(),
                complement:     $("#complementoCliente").val(),
                neighborhood:   $("#bairroCliente").val(),
                cep:            $("#cepCliente").val(),
                city:           $("#cidadeCliente").val(),
                state:          $("#estadoCliente").val()
            };
            $.ajax({
                url:"/api/clientes",
                data: cli,
                type: "POST",
                sucess:function(data){
                    cliente = JSON.parse(data);
                    linha = montarLinha(cliente);
                    $('#tabelaCliente>tbody').append(linha);
                         
                },
                error:function(error){
                    document.location.reload(true);
                    alert('CPF inválido!!');
                }
                
            });
            document.location.reload(true);
            alert('Cliente criado com sucesso'); 
        }
        
    //ABRI O FORMULÁRIO PARA EDITAR AS INFORMAÇÕES   
        function editar(id){ 
            $.getJSON('/api/clientes/'+ id, function(data){
                console.log(data);
                $("#id").val(data.id),
                $("#nomeCliente").val(data.name), 
                $("#cpfcpnj").val(data.cpf_cnpj),
                $("#nascimentoCliente").val(data.birth),  
                $("#logradouroCliente").val(data.public_place), 
                $("#numerocasaCliente").val(data.number),
                $("#complementoCliente").val(data.complement),
                $("#bairroCliente").val(data.neighborhood),
                $("#cepCliente").val(data.cep),
                $("#cidadeCliente").val(data.city),
                $("#estadoCliente").val(data.state)
                $('#dlgCliente').modal('show');
            });
        }
        
        $("#formCliente").submit( function(event){ //após apertar o botao, ele salvar ele faz uma verificação
            event.preventDefault(); 
            if ($("#id").val() != '')
                salvarCliente();
            else
                criarCliente();
                
            $("#dlgCliente").modal('hide');
        });

        $(function(){
            carregarCliente();
        });

    </script>
@endsection