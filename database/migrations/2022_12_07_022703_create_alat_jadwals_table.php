<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlatJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alat_jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('alat_id')->constrained('alats');
            $table->date('jadwal_kalibrasi');
            $table->string('kalibrator')->default('');
            $table->string('tempat_kalibrasi')->default('');
            $table->string('keberterimaan')->default('');
            $table->string('sertifikat_kalibrasi')->default('');
            $table->string('status');
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
        Schema::dropIfExists('Alat_jadwals');
    }
}
