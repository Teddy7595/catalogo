<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Productos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('cod')->unique();
            $table->string('name');
            $table->text('descp');
            $table->string('photo')->nullable();
            $table->double('precio_dls',10,2);
            $table->double('precio_eur',10,2)->nullable();
            $table->double('iva',3,2)->nullable();
            $table->integer('cantidad');
            $table->string('create_at');
            $table->string('update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
