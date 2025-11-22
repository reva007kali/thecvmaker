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
        Schema::create('cvs', function (Blueprint $table) {
            $table->id();
            // Relasi user
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Basic personal info
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('cv_photo')->nullable();
            $table->text('address')->nullable();
            $table->date('birthdate')->nullable();

            // Contact
            $table->string('phone')->nullable();
            $table->string('email')->nullable()->index();
            $table->json('social_media')->nullable();


            // CV contents
            $table->json('education')->nullable();
            $table->json('achievements')->nullable();
            $table->json('work_experience')->nullable();
            $table->json('certifications')->nullable();
            $table->json('soft_skills')->nullable();
            $table->json('hard_skills')->nullable();
            $table->json('languages')->nullable();
            $table->json('references')->nullable();

            // Optional extras
            $table->text('summary')->nullable();

            // Extra performance
            $table->index(['last_name', 'first_name']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cvs');
    }
};
