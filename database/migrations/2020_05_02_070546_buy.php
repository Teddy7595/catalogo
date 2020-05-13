<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Buy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catg_buys', function (Blueprint $table) 
        {
            $table->id();
            $table->foreignId('client_id')->constrained('catg_clients'); //codigo del cliente
            $table->foreignId('product_id')->constrained('catg_products'); //codigo del producto
            $table->double('cost',20,2); //costo del producto
            $table->integer('count'); //cantidad del producto
            $table->string('status')->default('IN_PROCESS'); // estatus de compra IN_PROCESS, COMPLETED, FREEZED
            $table->string('voucher'); //imagen o capture de la transferencia
            $table->string('nro referencia'); //nro de la referencia bancaria
            $table->timestamps(); //fechas de creacion y actualizacion
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catg_buys');
    }
}
