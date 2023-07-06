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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained(table:'users' , indexName:'orders_userId');
            $table->foreignId('product_id')->constrained(table:'products' , indexName:'orders_productId');
            $table->foreignId('address_id')->constrained(table:'addresses' , indexName:'orders_adressId');
            $table->foreignId('cart_id')->constrained(table:'carts' , indexName:'orders_cartId');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
