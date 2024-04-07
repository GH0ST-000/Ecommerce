<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('barcode');
            $table->integer('sku');
            $table->string('name');
            $table->longText('small_description');
            $table->longText('full_description');
            $table->string('size');
            $table->string('color');
            $table->string('brand');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
