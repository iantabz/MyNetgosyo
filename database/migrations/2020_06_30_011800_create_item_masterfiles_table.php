<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemMasterfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_masterfiles', function (Blueprint $table) {
            $table->id('item_masterfiles_id');
            $table->string('product_name')->nullable();
            $table->string('product_shrt_name')->nullable();
            $table->longText('description')->nullable();
            $table->string('company_code')->nullable();
            $table->string('itemcode')->nullable();
            $table->string('barcode')->nullable();
            $table->string('brand')->nullable();
            $table->string('principal')->nullable();
            $table->string('product_family')->nullable();
            $table->string('keywords')->nullable();
            $table->string('uom')->nullable();
            $table->string('list_price_wouttax')->nullable();
            $table->string('list_price_wtax')->nullable();
            $table->string('conversion_qty')->nullable();
            $table->string('conversion_uom')->nullable();
            $table->integer('isPromo')->nullable();
            $table->string('image',100)->nullable();
            $table->integer('order_count')->nullable();
            $table->string('date_uploaded')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('item_masterfiles');
    }
}
