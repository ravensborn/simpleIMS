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
        Schema::create('quick_pay_logs', function (Blueprint $table) {
            $table->id();

            $table->string('number');

            $table->unsignedBigInteger('customer_id');

            $table->foreign('customer_id')->references('id')
                ->on('customers')
                ->cascadeOnDelete();

            $table->json('orders');

            $table->decimal('amount_due_before_payment', 15, 2);
            $table->decimal('amount_paid', 15, 2);
            $table->decimal('remaining', 15, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quick_pay_logs');
    }
};
