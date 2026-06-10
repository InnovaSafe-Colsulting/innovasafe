<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('type_payment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_payment_detail')->constrained('type_payment');
            $table->string('agreement', 20)->nullable();
            $table->string('reference', 80)->nullable();
            $table->string('bank', 100)->nullable();
            $table->string('account_type', 50)->nullable();
            $table->string('account_number', 40)->nullable();
            $table->string('holder', 100)->nullable();
            $table->string('nit', 20)->nullable();
            $table->string('cellphone', 20)->nullable();
            $table->decimal('value', 12, 2)->nullable();
            $table->enum('status', ['1', '0'])->default('1');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('type_payment_details');
    }
};
