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
        Schema::create('belas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->string('category');
            $table->string('subcategory');
            $table->string('sku')->nullable();
            $table->string('warranty')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('weight')->nullable();
            $table->string('product')->nullable();
            $table->string('made_in')->nullable();
            $table->string('kbki')->nullable();
            $table->string('tkdn')->nullable();
            $table->string('bmp')->nullable();
            $table->string('tkdn_bmp')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('belas');
    }
};
