<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_post_tag', function (Blueprint $table) {
            $table->id();

           /* $table->unsignedBigInteger('blog_post_id')->index();
            $table->foreign('blog_post_id')->references('id')
                ->on('blog_posts');*/


            $table->unsignedBigInteger('blog_post_id');
            $table->foreign('blog_post_id')->references('id')->on('blog_posts');


            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags');




        /*    $table->unsignedBigInteger('tag_id')->index();
            $table->foreign('tag_id')->references('id')
                ->on('tags');*/

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
        Schema::dropIfExists('blog_post_tag');
    }
}
