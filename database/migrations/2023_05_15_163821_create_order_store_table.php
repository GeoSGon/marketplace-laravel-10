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
        Schema::create('order_store', function (Blueprint $table) {
            $table->unsignedBigInteger('store_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();

            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('order_id')->references('id')->on('user_orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_store');
    }
};
