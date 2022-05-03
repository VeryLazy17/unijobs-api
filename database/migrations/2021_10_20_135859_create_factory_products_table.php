<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactoryProductsTable extends Migration
{
    public function up()
    {
        Schema::create('factory_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('factory_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('product_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->float('amount', 15, 2);
            $table->enum('product_case', ['raw', 'painted', 'sewed', 'ready']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('factory_products');
    }
}
