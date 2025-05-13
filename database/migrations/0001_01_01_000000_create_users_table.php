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
            $table->id();

            // Name Fields
            $table->string('first_name');
            $table->string('last_name');

            // Contact
            $table->string('email')->unique();
            $table->string('whatsapp_number')->nullable();
            $table->string('farm_contact')->nullable();  // Contact number specific to the farm

            // Location
            $table->string('city')->nullable();

            // Role: farmer or buyer
            $table->enum('role', ['farmer', 'buyer'])->default('buyer');


            // Farm Details (only for farmers)
            $table->string('farm_name')->nullable();
            $table->string('farm_location')->nullable();
            $table->string('farm_size')->nullable();  // e.g., in hectares or acres
            $table->enum('farm_type', ['crop', 'livestock', 'mixed'])->nullable();
            $table->text('farm_products')->nullable();  // Description or list of products
            $table->text('about_farmer')->nullable();   // A brief about the farmer
            $table->json('social_media')->nullable();  // Social media links (as JSON)

            // Auth fields
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
