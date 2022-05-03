<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactoryCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('factory_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['material', 'collar', 'paint', 'factory']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('factory_categories');
    }
}
