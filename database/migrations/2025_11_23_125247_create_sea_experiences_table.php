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
        Schema::create('sea_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_id')->constrained('cvs')->cascadeOnDelete();
            // Informasi kapal
            $table->string('vessel_name');             // Nama kapal
            $table->string('vessel_type');             // Tipe: Tanker, Tugboat, Cargo, Container, dsb
            $table->integer('gross_tonnage')->nullable();  // GT optional
            $table->string('engine_type')->nullable();     // Jenis mesin (MAN B&W, Wärtsilä)
            $table->integer('engine_power')->nullable();   // HP / kW (opsional)

            // Posisi & perusahaan
            $table->string('rank');                    // Jabatan: AB, Oiler, Officer, dsb
            $table->string('company')->nullable();     // Perusahaan yang deploy
            $table->string('contract_type')->nullable(); // Permanent / Contract

            // Durasi pelayaran
            $table->date('sign_on');                   // Tanggal naik
            $table->date('sign_off')->nullable();      // Tanggal turun
            $table->boolean('is_current')->default(false); // Masih aktif di kapal ini?

            // Operational detail
            $table->string('sailing_area')->nullable(); // Asia, Europe, Worldwide
            $table->text('duties')->nullable();         // Deskripsi tugas harian
            $table->text('notes')->nullable();          // Catatan tambahan

            $table->integer('position')->default(0); // for ordering
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sea_experiences');
    }
};
