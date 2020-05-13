<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Notify extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catg_notify', function (Blueprint $table) 
        {
            $table->id(); //id unico incremental por noticia
            $table->string('sender_id'); // id de quien manda
            $table->string('reciver_id');// id de quien recibe 
            $table->string('link'); //link o direccion hacia donde apuntará la notificacion
            $table->text('body'); //descripción de la notificación
            $table->timestamp('created_at'); //marca de tiempo
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
