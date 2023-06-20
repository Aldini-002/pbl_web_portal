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
        Schema::create('ikuti_angkatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_batch');
            $table->foreignId('id_user');
            $table->enum('status', ['pending', 'terima', 'tolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ikuti_angkatans');
    }
};
