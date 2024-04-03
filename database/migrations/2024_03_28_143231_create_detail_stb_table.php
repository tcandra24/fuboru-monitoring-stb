<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailStbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_stb', function (Blueprint $table) {
            $table->unsignedBigInteger('nomer_kontrak');
            $table->integer('tahun');
            $table->integer('bulan');
            $table->decimal('omset', 12, 2);
            $table->decimal('total', 12, 2);
            $table->float('persentase');

            $table->foreign('nomer_kontrak')->references('nomer_kontrak')->on('master_stb')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_stb');
    }
}
