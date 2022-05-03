<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('parent_id')->nullable()->references('id')->on('product_categories');
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['null','thread', 'material', 'collar', 'accessory', 'product']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('');
    }
}
