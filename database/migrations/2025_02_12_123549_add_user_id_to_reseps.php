<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User; // Import model User
use App\Models\Resep; // Import model Resep

return new class extends Migration
{
    public function up()
    {
        Schema::table('reseps', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
        });

        // Beri nilai default ke user pertama yang ada di tabel users
        $defaultUser = User::first();
        if ($defaultUser) {
            Resep::whereNull('user_id')->update(['user_id' => $defaultUser->id]);
        }

        Schema::table('reseps', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->change();
        });
    }

    public function down()
    {
        Schema::table('reseps', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};

