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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wallet_id');
            $table->unsignedBigInteger('related_wallet_id')->nullable();
            $table->unsignedBigInteger('related_transaction_id')->nullable();
            $table->enum('type', ['deposit', 'withdraw', 'transfer']);
            $table->decimal('amount', 18, 2);
            $table->decimal('balance_before', 18, 2)->nullable();
            $table->decimal('balance_after', 18, 2)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
            // روابط الاختياري (بدون foreign key لحماية الأداء)

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
