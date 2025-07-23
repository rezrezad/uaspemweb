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
         Schema::create('properties', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('location');
        $table->decimal('price', 15, 2);
        $table->string('type'); // rumah, apartemen, tanah, dll.
        $table->integer('bedrooms');
        $table->integer('bathrooms');
        $table->float('land_area');
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->enum('status', ['available', 'sold'])->default('available');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
