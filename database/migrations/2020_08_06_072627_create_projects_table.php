<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('project_name')->nullable();
            $table->string('slug');
            $table->integer('space')->nullable();
            $table->string('company_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('note')->nullable();
            $table->string('status_id')->default(0);
            $table->integer('user_id')->nullable();
            $table->integer('error_id')->nullable();
            $table->enum('sent_welcome', [0, 1])->default(0);
            $table->text('available_status')->nullable();
            $table->enum('is_completed', [0, 1])->default(0);
            $table->enum('upfront_payment', [0, 1])->default(0);
            $table->string('testing_url')->nullable();
            $table->string('website_url')->nullable();
            $table->string('text_logo')->nullable();
            $table->string('image_logo')->nullable();
            $table->enum('action', [0,1,2,3])->default(0);
            $table->integer('reseller_id')->nullable();
            $table->integer('company_id')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
