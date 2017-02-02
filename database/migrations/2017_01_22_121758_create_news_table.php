<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {     
            $table->increments('id');
            $table->integer('category_id');
            $table->string('title');
            $table->string('image');
            $table->text('short_desc');
            $table->text('content');
            $table->boolean('active');
            $table->boolean('show_in_bar');
            $table->integer('views');
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
        Schema::drop('news');
    }
}
