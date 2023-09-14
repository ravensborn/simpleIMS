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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');

            $table->unsignedBigInteger('product_id')
                ->nullable();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('set null');

            $table->unsignedBigInteger('inventory_id')
                ->comment('Reference to product inventory item')
                ->nullable();
            $table->foreign('inventory_id')
                ->references('id')
                ->on('inventories')
                ->onDelete('set null');

            $table->json('inventory')
                ->comment('For report reasons just in case the inventory item was deleted.');

            $table->json('product')
                ->comment('For report reasons just in case the inventory item was deleted.');

            $table->integer('quantity');
            $table->decimal('price', 15, 2);

            $table->json('properties')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
