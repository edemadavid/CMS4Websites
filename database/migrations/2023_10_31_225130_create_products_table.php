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
            $table->uuid();
            $table->unsignedInteger('product_category_id');
            $table->string('name');
            $table->string('slug');
            $table->text('short_desc');
            $table->longText('long_desc');
            $table->integer('price');
            $table->integer('discount_price');
            $table->string('main_image');
            $table->string('other_image')->nullable();

            $table->softDeletes();
            $table->timestamps();
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
