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
        Schema::create('service_tag', function (Blueprint $table) {
            $table->id();
            $table->uuid('services_id');
            $table->uuid('tags_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('services_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('tags_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_tag');
    }
};
