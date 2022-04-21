<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopSalesmenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_salesmans', function (Blueprint $table) {
            $table->id();
            $table->string('salesman_code');
            $table->string('name');
            $table->string('address');
            $table->string('contact');
            $table->integer('status');
            $table->string('date');
            $table->integer('salesman_id');
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
        Schema::dropIfExists('top_salesmans');
    }
}
