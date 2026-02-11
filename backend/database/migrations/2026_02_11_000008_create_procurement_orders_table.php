<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('procurement_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('product_url');
            $table->string('product_name');
            $table->integer('quantity');
            $table->json('specifications')->nullable();
            $table->decimal('unit_price', 12, 2)->nullable();
            $table->decimal('total_price', 12, 2)->nullable();
            $table->string('currency')->default('CNY');
            $table->enum('status', ['pending', 'quoted', 'ordered', 'received_at_warehouse', 'shipped', 'delivered', 'cancelled'])->default('pending');
            $table->text('instructions')->nullable();
            $table->string('admin_notes')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('procurement_orders');
    }
};
