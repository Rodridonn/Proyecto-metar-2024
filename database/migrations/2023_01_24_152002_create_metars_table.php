<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metars', function (Blueprint $table) {
            $table->increments('id');
            
            $table->date('fecha_metar');
            $table->time('hora');
            $table->string('metar');
            $table->string('oaci_metar');
            $table->string('horario');
            $table->string('viento')->nullable();
            $table->string('visibilidad')->nullable();
            $table->string('tiempo_presente_1')->nullable();
            $table->string('tiempo_presente_2')->nullable();
            $table->string('tiempo_presente_3')->nullable();
            $table->string('nubosidad_1')->nullable();
            $table->string('nubosidad_2')->nullable();
            $table->string('nubosidad_3')->nullable();
            $table->string('nubosidad_4')->nullable();
            $table->string('temperatura')->nullable();
            $table->string('qnh_hpa')->nullable();
            $table->string('qnh_pulg_hg')->nullable();
            $table->string('qfe')->nullable();
            $table->string('h_relativa')->nullable();
            $table->string('p_cord')->nullable();
            $table->string('notas_metar')->nullable();



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
        Schema::dropIfExists('metars');
    }
};
