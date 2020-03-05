<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();                //chave primaria
            $table->string('name');                     //nome do clinte
            $table->string('cpf_cnpj', 14);                 //cpf ou cnpj
            $table->date('birth');                      //data nascimento
            $table->string('public_place');             //logradouro
            $table->integer('number');                  //numero
            $table->string('complement')->nullable();   //complemento
            $table->string('neighborhood');             //bairro
            $table->string('cep');                     //codigo de endereçamento postal
            $table->string('city');
            $table->string('state');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
