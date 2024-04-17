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
            $table->text('image');
            $table->string('name', 30);
            $table->text('description');
            $table->string('SKU', 30);
            $table->int('category_id');
            $table->int('inventory_id');
            $table->decimal('price');
            $table->int('discount_id');
            $table->timestamps('created_at');
            $table->timestamps('updated_at');
            
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
