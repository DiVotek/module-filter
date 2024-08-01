<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Filter\Models\SeoFilter;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(SeoFilter::getDb(), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('old_url');
            $table->string('new_url');
            $table->boolean('status')->default(1);
            SeoFilter::timestampFields($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(SeoFilter::getDb());
    }
};
