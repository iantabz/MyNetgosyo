<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesExportFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_export_files', function (Blueprint $table) {
            $table->id('sef_id');
            $table->string('sef_no');
            $table->string('cust_name');
            $table->string('po');
            $table->string('acct_code');
            $table->string('acct_name');
            $table->string('branch_code');
            $table->string('branch_name');
            $table->string('username');
            $table->string('usercode');
            $table->string('user_fname');
            $table->string('timestamp');
            $table->string('product_code');
            $table->string('product_name');
            $table->string('product_uom');
            $table->string('qty_for_delivery');
            $table->string('qty_ordered');
            $table->string('date_generate');
            $table->string('downloaded');
            $table->string('file_type');
            $table->string('tag');
            $table->string('date_req');
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
        Schema::dropIfExists('sales_export_files');
    }
}
