<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisposisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposisis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_surat');
            $table->date('tanggal_disposisi');
            $table->string('nomor');
            $table->string('perihal');
            $table->string('tujuan');
            $table->string('jenis_instruksi');
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
        Schema::dropIfExists('disposisis');
    }
}
