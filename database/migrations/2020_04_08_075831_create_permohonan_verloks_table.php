<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanVerloksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan_verloks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_surat');
            $table->string('nomor');
            $table->string('perihal');
            $table->string('nama_pemohon');
            $table->string('lng');
            $table->string('lat');
            $table->string('lokasi');
            $table->string('jenis_kegiatan');
            $table->string('tujuan');
            $table->date('tanggal_verlok');
            $table->timestamps();

            $table->foreign('id_surat')->references('id')->on('salinan_surats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permohonan_verloks');
    }
}
