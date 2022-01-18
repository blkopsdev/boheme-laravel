<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteTextAddingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_text_addings', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->text('direct_text')->nullable();
            $table->string('text_file')->nullable();
            $table->text('usp')->nullable();
            $table->text('titles')->nullable();
            $table->enum('team', [0, 1])->nullable();
            $table->text('team_text')->nullable();
            $table->string('team_doc')->nullable();
            $table->string('team_photo')->nullable();
            $table->enum('team_file_later', [0,1])->nullable();
            $table->string('terms_file')->nullable();
            $table->text('other_file')->nullable();
            $table->text('other_comment')->nullable();
            $table->enum('review', [0, 1])->nullable();
            $table->string('review_link')->nullable();
            $table->string('review_file')->nullable();
            $table->enum('review_file_later', [0,1])->nullable();
            $table->enum('portfolio', [0, 1])->nullable();
            $table->string('portfolio_link')->nullable();
            $table->string('portfolio_file')->nullable();
            $table->enum('portfolio_file_later', [0,1])->nullable();
            $table->enum('blog', [0, 1])->nullable();
            $table->string('blog_link')->nullable();
            $table->string('blog_file')->nullable();
            $table->enum('blog_file_later', [0,1])->nullable();
            $table->enum('newsletter', [0, 1])->nullable();
            $table->string('images_file')->nullable();
            $table->enum('dev_image', [0, 1])->nullable();
            $table->text('explanation')->nullable();
            $table->text('service_highlight')->nullable();
            $table->string('logo_file')->nullable();
            $table->string('main_color')->nullable();
            $table->string('sub_color_1')->nullable();
            $table->string('sub_color_2')->nullable();
            $table->enum('logo_color', [0,1])->nullable();
            $table->enum('status', [0,1])->default(0);
            $table->string('token')->nullable();
            $table->enum('sent_email', [0,1])->default(0)->nullable();
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
        Schema::dropIfExists('website_text_addings');
    }
}
