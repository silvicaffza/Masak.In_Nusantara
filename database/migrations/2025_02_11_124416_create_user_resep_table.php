
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
        Schema::create('user_reseps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Relasi ke tabel users
            $table->string('nama_masakan');
            $table->text('deskripsi');
            $table->string('foto_masakan')->nullable();
            $table->string('kategori');
            $table->text('bahan');
            $table->text('cara_pengolahan');
            $table->string('foto_langkah')->nullable();
            $table->string('link_youtube')->nullable();
            $table->timestamps();

            // Foreign key ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_reseps');
    }
};
