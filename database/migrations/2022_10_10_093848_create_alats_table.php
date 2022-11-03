<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('nama_alat');
            $table->string('merk');
            $table->string('type');
            $table->string('kode_alat');
            $table->string('no_seri');
            $table->text('spesifikasi');
            $table->text('keterangan');
            $table->string('lokasi');
            $table->integer('siklus_kalibrasi')->default(0);
            $table->string('status_kalibrasi')->default('');
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
        Schema::dropIfExists('alats');
    }
}
