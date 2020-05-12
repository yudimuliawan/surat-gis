<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalinanSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salinan_surats', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_surat');
            $table->string('tujuan');
            $table->date('tanggal_diterima');
            $table->string('asal');
            $table->string('nomor');
            $table->string('perihal');
            $table->string('nama_pt');
            $table->string('lampiran');
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
        Schema::dropIfExists('salinan_surats');
    }
}
