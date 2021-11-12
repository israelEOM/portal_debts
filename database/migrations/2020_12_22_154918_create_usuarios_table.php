<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tb_Usuario', function (Blueprint $table) {
            $table->increments('IDUSU_USU');
            $table->string('VLUSU_USU');
            $table->string('VLAVA_USU');
            $table->string('VLCPF_USU')->unique();
            $table->string('VLEMA_USU')->unique();
            $table->integer('VLTEL_USU');
            $table->boolean('STUSU_USU')->default(1);
            $table->timestamp('DTCAD_USU');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Tb_Usuario');
    }
}
