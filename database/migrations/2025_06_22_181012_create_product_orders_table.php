<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->id();

            // Foreign key references to users and products
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('farmer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('farm_products')->onDelete('cascade');

            // Order details
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 12, 2);

            // Status and payment
            $table->enum('status', [
                'pending', 'processing', 'shipped', 'delivered', 'cancelled'
            ])->default('pending');
            $table->string('payment_method')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('delivered_at')->nullable();

            // Additional info
            $table->longText('note')->nullable();
            $table->longText('shipping_address')->nullable();
            $table->string('tracking_number')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_orders');
    }
};
