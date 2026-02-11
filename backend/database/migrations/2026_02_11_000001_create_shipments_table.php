<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tracking_number')->unique();
            $table->string('origin');
            $table->string('origin_country');
            $table->string('destination');
            $table->string('destination_country');
            $table->enum('status', ['pending', 'picked_up', 'in_transit', 'customs', 'out_for_delivery', 'delivered', 'cancelled'])->default('pending');
            $table->decimal('weight', 10, 2)->nullable();
            $table->string('weight_unit')->default('kg');
            $table->decimal('price', 12, 2)->default(0);
            $table->string('currency')->default('USD');
            $table->string('receiver_name');
            $table->string('receiver_phone')->nullable();
            $table->string('receiver_email')->nullable();
            $table->text('description')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamp('estimated_delivery')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index('tracking_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
