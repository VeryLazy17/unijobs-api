<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSewingPaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('sewing_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('sewing_report_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->float('sum', 15, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sewing_payments');
    }
}
