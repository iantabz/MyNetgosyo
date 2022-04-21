<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerMasterFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_master_files', function (Blueprint $table) {
            $table->id('customer_id');
            $table->string('location_group_code');
            $table->string('location_code')->unique();
            $table->string('location_name');
            $table->string('address1');
            $table->string('address2');
            $table->string('address3'); 
            $table->string('address4');
            $table->string('address5');
            $table->string('postal_address');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('account_group_code');
            $table->string('account_group_name');
            $table->string('account_code')->unique();
            $table->string('account_code2');
            $table->string('account_code3');
            $table->string('account_name');
            $table->string('account_description');
            $table->string('account_credit_limit');
            $table->string('account_classification_id');
            $table->string('pricing_scheme_code');
            $table->string('payment_type');
            $table->string('number_of_days_credit');
            $table->string('branch_code');
            $table->string('branch_name');
            $table->string('branch_description');
            $table->string('branch_source_warehouse_code');
            $table->string('branch_order_delivery_lead_time');
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
        Schema::dropIfExists('customer_master_files');
    }
}
