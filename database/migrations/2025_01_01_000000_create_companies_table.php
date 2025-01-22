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
        Schema::create('companies', function (Blueprint $table) {
            $table->id("c_id");
            $table->string("c_name");
            $table->string("c_owner");
            $table->string("c_address");
            $table->string("c_email");
            $table->string("c_website");
            $table->string("c_logo");
            $table->string("c_phone");
            $table->string("c_password");
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
