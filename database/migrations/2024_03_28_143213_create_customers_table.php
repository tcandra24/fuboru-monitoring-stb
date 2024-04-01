<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->string('kode', 50)->primary();
            $table->string('nama', 100);
            $table->text('alamat');
            $table->string('kota', 100);
            $table->string('kode_pos', 20);
            $table->string('kecamatan', 50);
            $table->string('kelurahan', 50);
            $table->string('telepon', 20);
            $table->string('kode_divisi', 10);
            $table->string('nama_divisi', 50);
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
        Schema::dropIfExists('customers');
    }
}
