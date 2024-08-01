<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Filter\Models\Attribute;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Attribute::getDb(), function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->integer('sorting')->default(0);
            Attribute::timestampFields($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Attribute::getDb());
    }
};
