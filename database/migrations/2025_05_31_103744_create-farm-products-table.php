<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('farm_product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('farmer_id')->constrained('users')->onDelete('cascade');
            $table->longText('description')->nullable();
            $table->timestamps();
        });

        Schema::create('farm_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->foreignId('category_id')->constrained('farm_product_categories')->onDelete('cascade');
            $table->foreignId('farmer_id')->constrained('users')->onDelete('cascade');
            $table->string('unit_of_measurement')->comment('Unit of Measurement');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('selling_price', 10, 2)->nullable();
            $table->integer('total_stock')->default(0)->nullable();
            $table->string('product_image')->nullable();
            $table->string('tags')->nullable();
            $table->enum('status', ['published', 'draft', 'inactive'])->default('published');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('farm_products');
        Schema::dropIfExists('farm_product_categories');
    }
};
