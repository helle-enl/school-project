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
        Schema::create('farm_product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('farmer_id');
            $table->longText('description')->nullable();
            $table->timestamps();
        });

        Schema::create('farm_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->foreignId('category_id')->constrained('farm_product_categories')->onDelete('cascade');
            $table->string('farmer_id');
            $table->string('unit_of_measurement')->comment('Unit of Measurement');
            $table->string('unit_price');
            $table->string('selling_price')->nullable();
            $table->string('total_stock')->nullable()->default('0');
            $table->string('product_image')->nullable();
            $table->string('tags')->nullable();
            $table->enum('status', ['published', 'draft', 'inactive'])->default('published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm_products');
        Schema::dropIfExists('farm_products_categories');
    }
};
