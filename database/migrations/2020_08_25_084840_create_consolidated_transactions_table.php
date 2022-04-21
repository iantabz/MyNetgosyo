<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsolidatedTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consolidated_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_type');
            $table->string('sales_invoice');
            $table->string('customer_code');
            $table->string('posting_date');
            $table->string('itemcode');
            $table->integer('qty');
            $table->string('unit_price');
            $table->string('total_amt');
            $table->string('price_w_vat');
            $table->string('salesman_code');
            $table->string('uom');
            $table->string('reference_no');
            $table->string('status');
            $table->string('date_uploaded');
            $table->integer('flag');
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
        Schema::dropIfExists('consolidated_transactions');
    }
}
