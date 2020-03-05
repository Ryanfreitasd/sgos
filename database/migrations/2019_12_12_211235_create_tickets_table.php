<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();                 //vai ser o numero da ordem de serviço              
            $table->string('description')->nullable();     
            $table->date('delivery_date');      
            $table->string('content')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')
                    ->references('id')
                    ->on('statuses');
            $table->unsignedbigInteger('user_id')->nullable();          
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');

            $table->unsignedbigInteger('client_id');       
            $table->foreign('client_id')
                    ->references('id')
                    ->on('clients');

            $table->unsignedbigInteger('priority_id');      
            $table->foreign('priority_id')
                    ->references('id')
                    ->on('priorities');
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
        Schema::dropIfExists('tickets');
    }
}
