<?php

use App\Models\Categories;
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
            $table->string("name"); //? name
            $table->foreignIdFor(Categories::class , 'category_id')->constrained()->cascadeOnDelete();
//            $table->unsignedBigInteger("category_id"); //? category relation
            $table->foreignIdFor(\App\Models\brands::class , 'brand_id' )->constrained()->cascadeOnDelete();
//            $table->unsignedBigInteger("brand_id"); //?brand relation
            $table->integer("amount"); //?amount of product
            $table->double("price"); //? price of product
            $table->integer("discount"); //? discount of product
            $table->boolean("is_trendy"); //?if it's trendy
            $table->boolean("is_available"); //? if it's available
            $table->string("image")->nullable(); //? if it's available
            $table->timestamps();

//            $table->foreignId("category_id")->references("id")->on("categories")->cascadeOnDelete();
//            $table->foreignId("brands_id")->references("id")->on("brands")->cascadeOnDelete();
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
