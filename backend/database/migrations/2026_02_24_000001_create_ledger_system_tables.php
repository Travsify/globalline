<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── Platform Accounts (GlobalLine's own currency pools) ──
        Schema::create('platform_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('currency', 3)->unique(); // ISO 4217
            $table->decimal('balance', 15, 4)->default(0);
            $table->string('description')->default('');
            $table->timestamps();
        });

        // ── Double-Entry Ledger Journal ──
        Schema::create('ledger_entries', function (Blueprint $table) {
            $table->id();
            $table->uuid('transaction_group_id')->index();
            $table->unsignedBigInteger('account_id');
            $table->enum('account_type', ['user', 'platform']);
            $table->enum('entry_type', ['debit', 'credit']);
            $table->decimal('amount', 15, 4);
            $table->string('currency', 3);
            $table->decimal('balance_after', 15, 4);
            $table->string('description');
            $table->string('reference')->unique();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['account_id', 'account_type', 'currency']);
            $table->index(['currency', 'created_at']);
        });

        // ── Rate Locks (60-second rate guarantees) ──
        Schema::create('rate_locks', function (Blueprint $table) {
            $table->uuid('lock_id')->primary();
            $table->string('from_currency', 3);
            $table->string('to_currency', 3);
            $table->decimal('rate', 18, 8);
            $table->decimal('markup_pct', 5, 4)->default(0);
            $table->timestamp('expires_at');
            $table->boolean('used')->default(false);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->index(['user_id', 'used']);
            $table->index('expires_at');
        });

        // ── Fee Configurations (per-corridor, admin-managed) ──
        Schema::create('fee_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('corridor')->unique(); // e.g. USD_NGN
            $table->decimal('transfer_fee_flat', 10, 2)->default(0);
            $table->decimal('transfer_fee_pct', 5, 4)->default(0);
            $table->decimal('fx_markup_pct', 5, 4)->default(0.005); // 0.5% default
            $table->decimal('min_amount', 15, 2)->default(1);
            $table->decimal('max_amount', 15, 2)->default(50000);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // ── Seed default corridors ──
        DB::table('fee_configurations')->insert([
            [
                'corridor' => 'USD_NGN',
                'transfer_fee_flat' => 1.50,
                'transfer_fee_pct' => 0,
                'fx_markup_pct' => 0.005,
                'min_amount' => 1,
                'max_amount' => 50000,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'corridor' => 'USD_CNY',
                'transfer_fee_flat' => 2.00,
                'transfer_fee_pct' => 0,
                'fx_markup_pct' => 0.004,
                'min_amount' => 1,
                'max_amount' => 50000,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'corridor' => 'NGN_CNY',
                'transfer_fee_flat' => 500,
                'transfer_fee_pct' => 0,
                'fx_markup_pct' => 0.008,
                'min_amount' => 100,
                'max_amount' => 10000000,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'corridor' => 'SAME_CURRENCY',
                'transfer_fee_flat' => 0,
                'transfer_fee_pct' => 0,
                'fx_markup_pct' => 0,
                'min_amount' => 1,
                'max_amount' => 100000,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ── Seed platform pool accounts ──
        DB::table('platform_accounts')->insert([
            ['currency' => 'USD', 'balance' => 0, 'description' => 'GlobalLine USD Pool', 'created_at' => now(), 'updated_at' => now()],
            ['currency' => 'NGN', 'balance' => 0, 'description' => 'GlobalLine NGN Pool', 'created_at' => now(), 'updated_at' => now()],
            ['currency' => 'CNY', 'balance' => 0, 'description' => 'GlobalLine CNY Pool', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_configurations');
        Schema::dropIfExists('rate_locks');
        Schema::dropIfExists('ledger_entries');
        Schema::dropIfExists('platform_accounts');
    }
};
