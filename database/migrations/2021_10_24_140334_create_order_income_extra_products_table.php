<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderIncomeExtraProductsTable extends Migration
{
    public function up()
    {
        Schema::create('order_income_extra_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('order_income_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('product_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->float('percentage', 15, 2);
            $table->float('amount', 15, 2);
            $table->float('waste_percentage', 15, 2);
            $table->float('waste_amount', 15, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_income_extra_products');
    }
}
