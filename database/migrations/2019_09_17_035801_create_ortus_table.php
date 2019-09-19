<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrtusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ortus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('job_ayah')->nullable();
            $table->string('job_ibu')->nullable();
            $table->string('alamat_jl')->nullable();
            $table->string('alamat_desa')->nullable();
            $table->string('alamat_kec')->nullable();
            $table->string('alamat_kab')->nullable();
            $table->string('alamat_prov')->nullable();
            $table->string('hp_ortu')->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('job_wali')->nullable();
            $table->string('alamat_wali')->nullable();
            $table->string('hp_wali')->nullable();
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
        Schema::dropIfExists('ortus');
    }
}
