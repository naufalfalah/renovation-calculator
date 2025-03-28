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
        Schema::create('other_work_packages', function (Blueprint $table) {
            $table->id();
            $table->integer('min_property_size')->min(1);
            $table->integer('max_property_size')->max(999);
            $table->unsignedBigInteger('other_work_id');
            $table->string('name');
            $table->unsignedInteger('lower_bound_budget');
            $table->unsignedInteger('upper_bound_budget');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('other_work_id')->references('id')->on('works')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_work_packages');
    }
};
