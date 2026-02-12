<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('webhook_logs', function (Blueprint $table) {
            $table->id();
            $table->string('event');
            $table->string('url')->nullable();
            $table->json('payload')->nullable();
            $table->integer('response_code')->nullable();
            $table->text('response_body')->nullable();
            $table->string('status')->default('pending'); // pending, success, failed
            $table->integer('retries')->default(0);
            $table->timestamp('last_retry_at')->nullable();
            $table->timestamps();

            $table->index('event');
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('webhook_logs');
    }
};
