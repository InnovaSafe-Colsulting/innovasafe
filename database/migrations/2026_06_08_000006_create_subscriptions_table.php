<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->bigInteger('plan_id');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->nullable();
            $table->double('total_prize', 10, 2)->nullable();
            $table->enum('status_suscription', ['Active', 'Pending', 'Unsuscribe'])->default('Unsuscribe');
            $table->timestamps();

            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
