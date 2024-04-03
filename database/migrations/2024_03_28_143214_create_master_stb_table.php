<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterStbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_stb', function (Blueprint $table) {
            $table->bigInteger('nomer_kontrak')->primary();
            $table->string('kode_pelanggan', 50);
            $table->string('kode_area', 50);
            $table->string('kode_salesman', 50);
            $table->date('periode_awal');
            $table->date('periode_akhir');
            $table->decimal('target_rp', 12, 2);
            $table->float('hadiah_persen');
            $table->timestamps();

            $table->foreign('kode_pelanggan')->references('kode')->on('pelanggan');
            $table->foreign('kode_area')->references('kode')->on('cabang');
            $table->foreign('kode_salesman')->references('kode')->on('salesman');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_stb');
    }
}
