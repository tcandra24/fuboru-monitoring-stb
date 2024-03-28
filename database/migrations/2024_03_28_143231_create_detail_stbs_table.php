<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailStbsTable extends Migration
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
            $table->decimal('omset');
            $table->decimal('total');
            $table->integer('persentase');
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
