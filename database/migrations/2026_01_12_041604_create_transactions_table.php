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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('tx_code');
            $table->foreignId('examination_id')->constrained('examinations');
            $table->foreignId('pharmacist_id')->constrained('users');
            $table->enum('payment_method', ['cash', 'kredit', 'debit']);
            $table->bigInteger('payment_total');
            $table->bigInteger('payment_amount');
            $table->bigInteger('payment_change');
            $table->text('receipt_path')->nullable();
            $table->enum('status', ['paid', 'unpaid']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
