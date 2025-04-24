<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::create('jobs', function (Blueprint $table) {
      $table->id();
      $table->foreignId('alumni_id')->constrained()->onDelete('cascade');
      $table->string('nama_perusahaan');
      $table->string('jabatan');
      $table->string('bidang');
      $table->text('alamat_perusahaan');
      $table->year('tahun_masuk');
      $table->year('tahun_keluar')->nullable();
      $table->boolean('pekerjaan_saat_ini')->default(true);
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('jobs');
  }
};
