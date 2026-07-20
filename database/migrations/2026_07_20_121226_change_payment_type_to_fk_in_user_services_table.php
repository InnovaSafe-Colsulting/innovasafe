<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_services', function (Blueprint $table) {
            $table->dropColumn('payment_type');
        });

        Schema::table('user_services', function (Blueprint $table) {
            $table->foreignId('payment_type_id')->nullable()->after('payment_date')->constrained('type_payment')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('user_services', function (Blueprint $table) {
            $table->dropForeign(['payment_type_id']);
            $table->dropColumn('payment_type_id');
            $table->string('payment_type')->nullable()->after('payment_date');
        });
    }
};
