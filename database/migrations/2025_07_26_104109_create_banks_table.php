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
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique()->nullable();
            $table->enum('type', ['bank', 'sacco']);
            $table->decimal('annual_rate', 5, 2);  // e.g. 14.50
            $table->string('rate_type')->default('flat'); // or 'reducing'
            $table->unsignedBigInteger('min_amount')->default(10000);
            $table->unsignedBigInteger('max_amount')->nullable();
            $table->unsignedSmallInteger('min_months')->default(6);
            $table->unsignedSmallInteger('max_months')->default(60);
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banks');
    }
};
