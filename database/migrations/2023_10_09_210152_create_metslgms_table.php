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
        Schema::create('metslgms', function (Blueprint $table) {
            
            $table->increments('id');

            $table->date('fecha')->nullable();
            $table->time('gg')->nullable();
            $table->string('oaci');
            $table->integer('dd')->nullable();
            $table->integer('ff')->nullable();
            $table->integer('fmfm')->nullable();
            $table->integer('vvvv')->nullable();
            $table->string('dv')->nullable();
            $table->integer('ww')->nullable();
            $table->integer('ww1')->nullable();
            $table->integer('www')->nullable();
            $table->integer('ns1')->nullable();
            $table->integer('hhh1')->nullable();
            $table->string('cbtcu1')->nullable();
            $table->integer('ns2')->nullable();
            $table->integer('hhh2')->nullable();
            $table->string('cbtcu2')->nullable();
            $table->integer('ns3')->nullable();
            $table->integer('hhh3')->nullable();
            $table->string('cbtcu3')->nullable();
            $table->integer('ns4')->nullable();
            $table->integer('hhh4')->nullable();
            $table->float('tt')->nullable();
            $table->float('tbh')->nullable();
            $table->float('td')->nullable();
            $table->float('qfe')->nullable();
            $table->integer('qnh')->nullable();
            $table->float('pulg_hg')->nullable();
            $table->integer('uuu')->nullable();
            $table->string('notas')->nullable();

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
        Schema::dropIfExists('metslgms');
    }
};
