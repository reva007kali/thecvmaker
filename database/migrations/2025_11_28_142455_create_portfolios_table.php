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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            // Relasi ke User
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // Data Project
            $table->string('title'); // Judul Project (misal: Toko Online Laravel)
            $table->string('slug')->nullable(); // Untuk URL ramah SEO (opsional)
            $table->text('description')->nullable(); // Deskripsi singkat project
            
            // Media & Link
            $table->string('image_path')->nullable(); // Foto/Screenshot Project
            $table->string('project_url')->nullable(); // Link ke website/github/behance
            
            $table->date('completed_date')->nullable(); // Kapan project selesai
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
