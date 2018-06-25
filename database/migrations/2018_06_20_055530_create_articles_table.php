<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('article_category_id');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('contents');
            $table->string('image_path');
            $table->unsignedInteger('updated_user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('updated_user_id')->references('id')->on('users');
            $table->foreign('article_category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
