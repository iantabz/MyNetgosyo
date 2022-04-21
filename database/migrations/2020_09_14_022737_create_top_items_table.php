<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_items', function (Blueprint $table) {
            $table->id();
            $table->string('itemcode');
            $table->string('uom');
            $table->string('description');
            $table->integer('status');
            $table->string('date');
            $table->integer('item_masterfiles_id');
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
        Schema::dropIfExists('top_items');
    }
}
