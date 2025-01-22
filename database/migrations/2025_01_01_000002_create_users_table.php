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
        Schema::create('users', function (Blueprint $table) {
            $table->id("u_id");
            $table->string('u_passportNumber');
            $table->string('u_name');
            $table->string('u_surname');
            $table->string('u_middle_name');
            $table->string('u_position');
            $table->string('u_phone');
            $table->string('u_address');
            #------------ Companies m-2-1 Users [START] ------------#
            $table->foreignId("u_company_id")
                ->constrained(
                    table: "companies",
                    column: "c_id",
                )
                ->cascadeOnDelete();
            #------------ Companies m-2-1 Users [END] ------------#
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
