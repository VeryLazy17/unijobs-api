<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSewingReportsTable extends Migration
{
    public function up()
    {
        Schema::create('sewing_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('product_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->text('color')->nullable();
            $table->float('amount', 15, 2);
            $table->float('amount_using', 15, 2);
            $table->float('amount_sewed', 15, 2);
            $table->float('waste_percentage', 15, 2);
            $table->float('waste_amount', 15, 2);
            $table->float('total_price', 15, 2);
            $table->enum('is_debt', ['0', '1']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sewing_reports');
    }
}
