<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentAddingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_addings', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->text('description')->nullable();
            $table->text('usps')->nullable();
            $table->text('other_comment')->nullable();
            $table->enum('review', [0, 1])->nullable();
            $table->string('review_link')->nullable();
            $table->enum('review_file_later', [0, 1])->default(0)->nullable();
            $table->enum('newsletter', [0, 1])->nullable();
            $table->text('pages')->nullable();
            $table->text('page_descriptions')->nullable();
            $table->string('website_image')->nullable();
            $table->enum('website_image_source', [0, 1])->default(0)->nullable();
            $table->text('website_image_comment')->nullable();
            $table->string('payment_live_key')->nullable();
            $table->string('payment_test_key')->nullable();
            $table->string('token')->nullable();
            $table->enum('sent_email', [0,1])->default(0)->nullable();
            $table->enum('status', [0, 1])->default(0)->nullable();
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
        Schema::dropIfExists('content_addings');
    }
}
