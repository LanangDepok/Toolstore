<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pinjams', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_alat');
            $table->string('alat');
            $table->string('jumlah');
            $table->string('nama');
            $table->string('nim');
            $table->string('kelas');
            $table->string('email');
            $table->string('tempat');
            $table->string('keperluan');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjams');
    }
};