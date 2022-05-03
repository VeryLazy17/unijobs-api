<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorageIncomesTable extends Migration
{
    public function up()
    {
        Schema::create('storage_incomes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('product_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->float('percentage', 15, 2);
            $table->float('amount', 15, 2);
            $table->float('waste_percentage', 15, 2);
            $table->float('waste_amount', 15, 2);
            $table->foreignId('factory_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('order_income_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('storage_icnomes');
    }
}
