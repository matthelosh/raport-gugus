<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTematiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tematiks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tingkat_id');
            $table->string('mapel_id');
            $table->string('kd_id');
            $table->string('tema_id');
            $table->string('subtema_id');
            $table->string('ket');
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
        Schema::dropIfExists('tematiks');
    }
}
