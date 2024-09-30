<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('ekskul', function (Blueprint $table) {
        $table->id();
        $table->foreignId('divisi_id')->constrained('divisi')->onDelete('cascade');
        $table->foreignId('pembimbing_id')->constrained('users')->onDelete('cascade');
        $table->string('name');
        $table->string('hari');
        $table->time('jam');
        $table->string('lokasi');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('ekskul');
}

};
