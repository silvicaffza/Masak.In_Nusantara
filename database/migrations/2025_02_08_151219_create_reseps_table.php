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
        Schema::create('reseps', function (Blueprint $table) {
            $table->id();
            $table->string('nama_masakan');
            $table->text('deskripsi');
            $table->string('kategori');
            $table->string('foto_masakan')->nullable();
            $table->text('bahan');
            $table->text('cara_pengolahan');
            $table->string('foto_langkah')->nullable();
            $table->string('link_youtube')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pastikan ada ini
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reseps');
    }
};
