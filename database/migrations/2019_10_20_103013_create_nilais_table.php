<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tapel');
            $table->string('semester');
            $table->string('periode');
            $table->string('rombel_id');
            $table->string('mapel_id');
            $table->string('subtema_id');
            $table->string('kd_id');
            $table->string('aspek_id');
            $table->string('tipe_nilai_id');
            $table->string('guru_id');
            $table->string('siswa_id');
            $table->float('nilai');
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
        Schema::dropIfExists('nilais');
    }
}
