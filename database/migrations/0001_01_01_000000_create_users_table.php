<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Users table
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Name
            $table->string('first_name');
            $table->string('last_name');

            // Contact
            $table->string('email')->unique();
            $table->string('whatsapp_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('profile_picture')->nullable();

            // Location
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();

            // Role
            $table->enum('role', ['farmer', 'buyer'])->default('buyer');

            // Farmer Info
            $table->string('farm_name')->nullable();
            $table->string('farm_location')->nullable();
            $table->string('farm_size')->nullable(); // Prefer storing this as string unless you want numeric sorting
            $table->enum('farm_type', ['crop', 'livestock', 'mixed'])->nullable();
            $table->text('about_farmer')->nullable();
            $table->json('social_media')->nullable(); // PostgreSQL handles JSON well, MySQL 5.7+ too
            $table->string('farm_contact')->nullable();

            // Auth
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->timestamps();
        });

        // Password resets
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Sessions table (Postgres note: bigint = integer mismatch fix)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->unsignedBigInteger('last_activity')->index(); // Use unsignedBigInteger for cross-db compatibility
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
