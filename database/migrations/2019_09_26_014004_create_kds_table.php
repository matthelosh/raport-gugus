<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_kd');
            $table->string('teks_kd');
            $table->string('tingkat');
            $table->string('id_ki');
            $table->string('id_subtema');
            $table->string('id_tema');
            $table->string('id_mapel');
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
        Schema::dropIfExists('kds');
    }
}
