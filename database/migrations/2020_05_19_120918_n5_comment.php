<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class N5Comment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('n5_comment', function (Blueprint $table) {
            $table->increments('com_id');
            $table->string('com_email');
            $table->string('com_name');
            $table->string('com_content');
            $table->integer('com_product')->unsigned();
            $table->foreign('com_product')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('n5_comment');
    }
}
