<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->unsignedInteger('items_count');
            $table->unsignedBigInteger('total_amount'); // cents
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->foreignId('product_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('unit_price'); // cents
            $table->unsignedBigInteger('line_total'); // cents
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
