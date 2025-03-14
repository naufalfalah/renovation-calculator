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
        Schema::create('renovations', function (Blueprint $table) {
            $table->id();
            $table->enum('property_type', ['hdb', 'condo', 'landed']);
            $table->enum('property_condition', ['new', 'resale']);
            $table->enum('base_unit', ['m2', 'sqft']);
            $table->integer('size');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renovations');
    }
};
