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
        Schema::create('datapinjams', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_alat')->nullable();
            $table->string('alat')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('nama')->nullable();
            $table->string('nim')->nullable();
            $table->string('kelas')->nullable();
            $table->string('email')->nullable();
            $table->string('image')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('keperluan');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datapinjams');
    }
};