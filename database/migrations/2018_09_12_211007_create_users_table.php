<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');                             //nome do usuario
            $table->string('email')->unique();                  //email do usuario                            //status (s) ativo (n) desativado 
            $table->timestamp('email_verified_at')->nullable(); // verificação do email
            $table->string('password');                         // senha do usuario
            $table->unsignedBigInteger('team_id')->nullable();              // id equipe chave estrangeira
            $table->foreign('team_id')
                    ->references('id')
                    ->on('teams');
            
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
