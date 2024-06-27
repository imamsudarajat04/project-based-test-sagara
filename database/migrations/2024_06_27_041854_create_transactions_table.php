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
            $table->uuid('id')->primary();
            $table->foreignUuid('product_id')
                ->constrained('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
                ->nullable();
            $table->foreignUuid('service_id')
                ->constrained('services')
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
                ->nullable();
            $table->foreignUuid('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('quantity');
            $table->decimal('total', 15, 2);
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->softDeletes();
            $table->timestamps();
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
