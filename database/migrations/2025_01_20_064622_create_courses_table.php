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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Kursus
            $table->text('description'); // Deskripsi
            $table->decimal('price', 10, 2); // Harga
            $table->enum('status', ['active', 'inactive'])->default('inactive'); // Status (aktif/tidak aktif)
            $table->unsignedInteger('student_count')->default(0); // Jumlah Siswa yang Terdaftar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
