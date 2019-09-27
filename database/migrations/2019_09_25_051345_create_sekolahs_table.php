<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSekolahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolahs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nss');
            $table->string('npsn');
            $table->string('nama_sekolah');
            $table->string('alamat_jl');
            $table->string('alamat_desa');
            $table->string('alamat_kec');
            $table->string('alamat_kab');
            $table->string('alamat_prov');
            $table->string('telp');
            $table->string('email');
            $table->string('website');
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
        Schema::dropIfExists('sekolahs');
    }
}
