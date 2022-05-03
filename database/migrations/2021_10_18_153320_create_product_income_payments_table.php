<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductIncomePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('product_income_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('product_income_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->float('sum', 15, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_income_payments');
    }
}
