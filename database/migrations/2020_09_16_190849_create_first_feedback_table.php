<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirstFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('first_feedback', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->string('page_names')->nullable();
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
        Schema::dropIfExists('first_feedback');
    }
}
