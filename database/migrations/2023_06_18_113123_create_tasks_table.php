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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_batch');
            $table->foreignId('id_course');
            $table->foreignId('id_materi');
            $table->string('title');
            $table->string('file');
            $table->string('description')->nullable();
            $table->date('start');
            $table->date('end');
            $table->enum('status', ['akan datang', 'berlangsung', 'selesai'])->default('akan datang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
