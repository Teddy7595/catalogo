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
        Schema::create('catg_users', function (Blueprint $table) 
        {
            $table->id();
            $table->string('name'); //nombre del usuario
            $table->string('email')->unique(); //emqail de contacto
            $table->timestamp('email_verified_at')->nullable(); //fecha de verificación de email
            $table->string('password'); // contraseña
            $table->rememberToken()->nullable(); //moneda de recordatorio
            $table->timestamps(); //estampas de fecha
            $table->string('role')->default('cliente_role'); //role de usuario
            $table->boolean('is_admin')->default(false);// booleano de administracion
            $table->string('img')->nullable(); //imagen de perfil
            $table->string('ci',20);// cedula
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catg_users');
    }
}
