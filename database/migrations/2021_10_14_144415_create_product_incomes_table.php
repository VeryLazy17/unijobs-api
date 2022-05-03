<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductIncomesTable extends Migration
{
    public function up()
    {
        Schema::create('product_incomes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->text('from_where')->nullable();
            $table->foreignId('product_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->float('amount', 15, 2);
            $table->float('price', 15, 2);
            $table->float('total_price', 15, 2);
            $table->enum('is_debt', ['0', '1']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_incomes');
    }
}
