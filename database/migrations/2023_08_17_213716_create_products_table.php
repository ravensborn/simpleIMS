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
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            $table->string('number');
            $table->string('name');
            $table->string('code')->nullable();

            $table->bigInteger('available_inventory')->default(0);
            $table->bigInteger('times_sold')->default(0);

            $table->unsignedBigInteger('default_inventory_id')
                ->nullable();

            $table->longText('note')
            ->nullable();

            $table->json('properties')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
