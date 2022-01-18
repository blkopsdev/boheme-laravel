<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_feedback', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->text('page_names')->nullable();
            $table->text('page_feedbacks')->nullable();
            $table->enum('status', [0, 1])->default(0);
            $table->enum('sent_email', [0,1])->default(0)->nullable();
            $table->string('token')->nullable();
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
        Schema::dropIfExists('website_feedback');
    }
}
