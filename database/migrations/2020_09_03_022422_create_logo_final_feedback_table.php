<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogoFinalFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logo_final_feedback', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->string('filename')->nullable();
            $table->text('feedback')->nullable();
            $table->text('files')->nullable();
            $table->string('token')->nullable();
            $table->enum('sent_email', [0,1])->default(0)->nullable();
            $table->enum('status', [0, 1])->default(0);
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
        Schema::dropIfExists('logo_final_feedback');
    }
}
