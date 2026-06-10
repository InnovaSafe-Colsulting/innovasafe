<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['name', 'email_verified_at', 'remember_token']);
            $table->string('names', 80)->nullable()->after('id');
            $table->string('last_names', 80)->nullable()->after('names');
            $table->foreignId('city_id')->constrained('cities')->after('last_names');
            $table->string('address', 200)->nullable()->after('city_id');
            $table->string('neighboarhood', 200)->nullable()->after('address');
            $table->string('cellphone', 12)->nullable()->after('neighboarhood');
            $table->foreignId('role_id')->constrained('roles')->after('password');
            $table->enum('status', ['1', '0'])->default('1')->after('role_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('email', 80)->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropForeign(['role_id']);
            $table->dropColumn(['names', 'last_names', 'city_id', 'address', 'neighboarhood', 'cellphone', 'role_id', 'status']);
            $table->string('name');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
        });
    }
};
