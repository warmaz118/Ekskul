<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique(); // Nomor Induk Siswa
            $table->string('name'); // Nama Siswa
            $table->string('kelas'); // Kelas Siswa
            $table->string('alamat'); // Alamat Siswa
            $table->string('password'); // Password Siswa
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade'); // Relasi ke tabel roles
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
