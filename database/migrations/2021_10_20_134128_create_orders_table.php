<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->foreignId('factory_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('product_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->text('color_code')->nullable();
            $table->float('amount', 15, 2);
            $table->float('price', 15, 2);
            $table->float('total_price', 15, 2);
            $table->enum('type', ['material', 'collar', 'painting', 'sewing']);
            $table->enum('status', ['in_process', 'finished']);
            $table->enum('is_debt', ['0', '1']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
