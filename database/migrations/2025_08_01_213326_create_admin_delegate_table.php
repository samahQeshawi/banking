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
        Schema::create('admin_delegate', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');

            // إلى من التفويض (المفوّض)
            $table->foreignId('delegate_id')->constrained('admins')->onDelete('cascade');
    
    // البيانات الإضافية
            $table->string('id_number')->nullable();
    $table->string('problem')->nullable();
    $table->string('delegation_duration')->nullable();
    $table->string('agency_number')->nullable();
    $table->string('agency_type')->nullable();
    $table->decimal('max_amount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_delegate');
    }
};
