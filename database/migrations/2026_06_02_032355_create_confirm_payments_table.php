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
        Schema::create('confirm_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_id')->nullable();
            $table->foreignId('payment_type_id')->constrained('type_payment')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->decimal('amount', 12, 2);
            $table->string('payer_name')->nullable();
            $table->date('payment_date')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0: Pendiente, 1: Aprobado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirm_payments');
    }
};
