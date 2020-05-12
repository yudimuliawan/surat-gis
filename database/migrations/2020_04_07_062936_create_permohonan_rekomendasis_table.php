<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanRekomendasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan_rekomendasis', function (Blueprint $table) {
            $table->id();
            $table->string('tujuan');
            $table->string('asal');
            $table->string('nomor');
            $table->string('perihal');
            $table->string('nama_pt');
            $table->string('pj');
            $table->string('lokasi');
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
        Schema::dropIfExists('permohonan_rekomendasis');
    }
}
