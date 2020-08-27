<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            //$table->increments('id',11);
            $table->id();
            //$table->primary('id');
            $table->integer('dni')->unique();
            $table->string('apellido',40);
            $table->string('nombre',40);
            $table->date('fecha_nac');
            $table->string('domicilio',100);
            //$table->string('tipo',25);
            $table->integer('telefono');
            $table->enum('tipo',['medico','paciente'])->default('paciente');
            $table->foreignId('login_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('people');
    }
}
