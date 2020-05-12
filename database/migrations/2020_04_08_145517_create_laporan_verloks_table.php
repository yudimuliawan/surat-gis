<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanVerloksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_verloks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_permohonan_verlok');
            $table->string('nomor');
            $table->string('perihal');
            $table->string('tujuan');
            $table->date('tanggal_survey');
            $table->string('waktu_survey');
            $table->string('lng');
            $table->string('lat');
            $table->string('hasil_verifikasi');
            $table->string('foto_kegiatan');
            $table->string('saran');

            $table->foreign('id_permohonan_verlok')->references('id')->on('permohonan_verloks');
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
        Schema::dropIfExists('laporan_verloks');
    }
}
