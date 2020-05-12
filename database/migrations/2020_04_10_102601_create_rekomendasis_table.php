<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekomendasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekomendasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_surat');
            $table->unsignedBigInteger('id_laporan_verlok');
            $table->string('nomor');
            $table->String('perihal');
            $table->string('tujuan');
            $table->text('isi');
            $table->string('luas');

            $table->foreign('id_surat')->references('id')->on('salinan_surats');
            $table->foreign('id_laporan_verlok')->references('id')->on('laporan_verloks');
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
        Schema::dropIfExists('rekomendasis');
    }
}
