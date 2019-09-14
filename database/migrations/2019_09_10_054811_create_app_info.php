<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('npsn');
            $table->string('nss');
            $table->string('nama_sekolah');
            $table->string('alamat_sekolah');
            $table->string('telp_sekolah');
            $table->string('email_sekolah');
            $table->string('web_sekolah');
            $table->string('status_sekolah');
            $table->string('kepala_sekolah');
            $table->string('nip_ks');
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
        Schema::dropIfExists('app_info');
    }
}
