<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->string('order_no');
            $table->integer('identifier');
            $table->string('order_by');
            $table->string('type');
            $table->string('status');
            $table->string('customer_name');
            $table->string('po_no');
            $table->string('account_code');
            $table->string('account_name');
            $table->string('branch_code');
            $table->string('branch_name');
            $table->string('username');
            $table->string('user_code');
            $table->string('user_fullname');
            $table->timestamps();
            $table->string('product_code');
            $table->string('product_name');
            $table->string('product_uom');
            $table->string('quantity_delivered');
            $table->string('quantity_ordered');
            $table->string('downloaded');
            $table->integer('flag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_orders');
    }
}
