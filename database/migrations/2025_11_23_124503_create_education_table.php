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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
             $table->foreignId('cv_id')->constrained('cvs')->cascadeOnDelete();
            $table->string('school')->nullable();
            $table->string('degree')->nullable();
            $table->string('location')->nullable();
            $table->date('year_start')->nullable();
            $table->date('year_end')->nullable();
            $table->integer('position')->default(0); // for ordering
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
