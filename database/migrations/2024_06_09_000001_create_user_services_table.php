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
        Schema::create('user_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('order_id');
            $table->date('payment_date'); // Siempre último día del mes
            $table->string('payment_type'); // tarjeta, transferencia, etc.
            $table->enum('billing_period', ['monthly', 'yearly']);
            $table->date('expires_at'); // Fecha de expiración del servicio
            $table->enum('status', ['active', 'expired', 'canceled'])->default('active');
            $table->timestamps();
            
            // Índices para consultas frecuentes
            $table->index(['user_id', 'status']);
            $table->index('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_services');
    }
};