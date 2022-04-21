<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pages', function (Blueprint $table) {
            $table->id();
            $table->string("page_route");
            $table->string("page_title");
            $table->string("page_root");
            $table->string("page_header");
            $table->string("page_btn_name");
            $table->string("page_btn_icon");
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
        Schema::dropIfExists('tbl_pages');
    }
}
