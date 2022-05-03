<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebtorHistoryPaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('debtor_history_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('debtor_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->float('sum', 15, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('debtor_history_payments');
    }
}
