<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->string('transaction_no');
            $table->integer('order_id');
            $table->string('customer_no');
            $table->string('customer_name');
            $table->string('store_name');
            $table->string('certificate_no');
            $table->string('mobile_no');
            $table->string('address');
            $table->integer('salesman_no');
            $table->string('transaction_status');
            $table->string('transaction_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
