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
        Schema::create('return_and_refund_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('return_and_refund_id');
            $table->foreignId('product_id');
            $table->unsignedBigInteger('variation_id')->nullable();
            $table->string('variation_names')->nullable();
            $table->bigInteger('quantity')->default(1);
            $table->unsignedDecimal('price', 13, 6)->default(0);
            $table->unsignedDecimal('total', 13, 6)->default(0);
            $table->unsignedDecimal('return_price', 13, 6);
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_and_refund_products');
    }
};