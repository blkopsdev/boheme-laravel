<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirstHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('first_homes', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->text('feedback')->nullable();
            $table->string('token')->nullable();
            $table->enum('status', [0,1])->default(0);
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
        Schema::dropIfExists('first_homes');
    }
}
