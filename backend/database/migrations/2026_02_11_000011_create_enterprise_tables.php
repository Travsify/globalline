<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Multi-currency Wallet Balances
        Schema::create('wallet_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('currency'); // USD, CNY, NGN
            $table->decimal('amount', 15, 2)->default(0);
            $table->timestamps();

            $table->unique(['user_id', 'currency']);
        });

        // KYC Verifications
        Schema::create('kyc_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('id_type'); // NIN, Passport, BVN
            $table->string('id_number');
            $table->string('document_url')->nullable();
            $table->string('status')->default('pending'); // pending, verified, rejected
            $table->text('reason')->nullable();
            $table->string('provider_reference')->nullable(); // For Prembly
            $table->timestamps();
        });

        // Shipment Consolidations
        Schema::create('shipment_consolidations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('master_tracking_number')->unique();
            $table->string('status')->default('pending'); 
            $table->decimal('total_weight', 10, 2)->default(0);
            $table->timestamps();
        });

        // Update shipments table for consolidation and insurance
        Schema::table('shipments', function (Blueprint $table) {
            $table->foreignId('consolidation_id')->nullable()->constrained('shipment_consolidations')->onDelete('set null');
            $table->boolean('is_insured')->default(false);
            $table->decimal('insurance_premium', 10, 2)->nullable();
        });

        // Digital Packing List Items
        Schema::create('packing_list_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id')->constrained()->onDelete('cascade');
            $table->string('item_name');
            $table->integer('quantity');
            $table->decimal('unit_value', 10, 2)->nullable();
            $table->string('category')->nullable();
            $table->timestamps();
        });

        // Bespoke Sourcing Requests
        Schema::create('sourcing_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('product_name');
            $table->text('description')->nullable();
            $table->string('reference_image_url')->nullable();
            $table->string('status')->default('open'); // open, searching, quoted, completed
            $table->decimal('target_price', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sourcing_requests');
        Schema::dropIfExists('packing_list_items');
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropForeign(['consolidation_id']);
            $table->dropColumn(['consolidation_id', 'is_insured', 'insurance_premium']);
        });
        Schema::dropIfExists('shipment_consolidations');
        Schema::dropIfExists('kyc_verifications');
        Schema::dropIfExists('wallet_balances');
    }
};
