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
        Schema::create('attribute_products', function (Blueprint $table) {
            $table->unsignedBigInteger('attribute_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('language_id');
            $table->string('value');

            $table->foreign('attribute_id')->references('id')->on(\Modules\Filter\Models\Attribute::getDb())->cascadeOnDelete('cascade')->cascadeOnUpdate();
            $table->foreign('product_id')->references('id')->on(\Modules\Product\Models\Product::getDb())->cascadeOnDelete('cascade')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_products');
    }
};
