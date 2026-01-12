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
            $table->string('examination_code')->unique();
            $table->foreignId('patient_id')->constrained(
                table: 'patients',
            );
            $table->foreignId('doctor_id')->constrained(
                table: 'users',
            );

            $table->timestamp('examined_at');
            $table->integer('height')->nullable()->comment('height in cm');
            $table->integer('weight')->nullable()->comment('weight in kg');
            $table->integer('systole')->nullable();
            $table->integer('diastole')->nullable();
            $table->integer('heart_rate')->nullable();
            $table->integer('respiration_rate')->nullable();
            $table->decimal('body_temp', 4, 1)->nullable();
            $table->text('doctor_notes')->nullable();
            $table->enum('status', ['prescribed', 'served', 'deleted'])->default('prescribed');
            $table->foreignId('pharmacist_id')->nullable()->constrained(
                table: 'users',
                indexName: 'pharmacist_id'
            );
            $table->timestamp('served_at')->nullable();
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
