<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tempat');
            $table->string('alamat');
            $table->string('latitude');
            $table->string('longitude');
            $table->text('deskripsi')->nullable();
            $table->integer('harga_tiket')->nullable();
            $table->string('hari_buka')->nullable();
            $table->string('hari_tutup')->nullable();
            $table->time('jam_buka')->nullable();
            $table->time('jam_tutup')->nullable();
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
        Schema::dropIfExists('tempats');
    }
};
