<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('barrio',60);
            $table->string('calle',60);
            $table->smallInteger('numero');
            $table->smallInteger('piso');
            $table->string('oficina',5);
            $table->string('latitud');
            $table->string('telefono');
            $table->string('longitud');
            $table->string('intervalo_atencion');
            $table->string('intervalo_consulta');
            $table->string('ubicacion');
            $table->enum('tipo_atencion',['atencion','consulta'])->default('consulta');
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
        Schema::dropIfExists('offices');
    }
}
