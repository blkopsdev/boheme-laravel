<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextWritingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_writings', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->text('market')->nullable();
            $table->text('usp')->nullable();
            $table->text('competitors')->nullable();
            $table->enum('focus', [0, 1, 2, 3, 4])->default(0);
            $table->text('customers')->nullable();
            $table->text('wishes')->nullable();
            $table->text('concrete')->nullable();
            $table->text('promise')->nullable();
            $table->text('page_names')->nullable();
            $table->text('guidelines')->nullable();
            $table->text('page_files')->nullable();
            $table->text('working_method')->nullable();
            $table->text('visitor_description')->nullable();
            $table->string('token')->nullable();
            $table->enum('status', [0, 1])->default(0);
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
        Schema::dropIfExists('text_writings');
    }
}
