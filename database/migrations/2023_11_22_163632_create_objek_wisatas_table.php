<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('objekwisatas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('deskripsi');
            $table->string('kategori');
            $table->string('gambar')->nullable();
            $table->double('rating');
            $table->double('harga');
            $table->string('pulau');
            $table->integer('durasi');
            $table->string('akomodasi')->nullable();
            $table->string('transportasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objekwisatas');
    }
};
