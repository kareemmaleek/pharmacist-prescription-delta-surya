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
        Schema::create('examinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained(
                table: 'patients',
                indexName: 'patient_id'
            );
            $table->foreignId('doctor_id')->constrained(
                table: 'users',
                indexName: 'doctor_id'
            );

            $table->timestamp('examined_at');
            $table->integer('height')->nullable()->comment('height in cm');
            $table->integer('weight')->nullable()->comment('weight in kg');
            $table->integer('systole')->nullable();
            $table->integer('diastole')->nullable();
            $table->integer('heart_rate')->nullable();
            $table->integer('respiration_rate')->nullable();
            $table->integer('body_temp')->nullable();
            $table->text('doctor_notes')->nullable();
            $table->json('attachments')->nullable();
            $table->enum('status', ['prescribed', 'served'])->default('prescribed');
            $table->foreignId('pharmacist_id')->nullable()->constrained(
                table: 'users',
                indexName: 'pharmacist_id'
            );
            $table->timestamp('served_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examinations');
    }
};
