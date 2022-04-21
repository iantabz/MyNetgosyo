<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemHistoryLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_history_logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->integer('item_masterfile_id');
            $table->string('product_name');
            $table->string('itemcode');
            $table->string('uom');
            $table->string('price1');
            $table->string('price2');
            $table->string('uom1');
            $table->string('uom2');
            $table->string('product_family1');
            $table->string('product_family2');
            $table->string('principal1');
            $table->string('principal2');
            $table->string('brand1');
            $table->string('brand2');
            $table->string('keywords1');
            $table->string('keywords2');
            $table->string('description1');
            $table->string('description2');
            $table->string('date_from');
            $table->string('date_to');
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
        Schema::dropIfExists('item_history_logs');
    }
}
