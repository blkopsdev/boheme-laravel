<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogoDesignFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logo_design_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->string('company_name')->nullable();
            $table->string('slogan')->nullable();
            $table->string('niche')->nullable();
            $table->string('types')->nullable();
            $table->enum('favorite_logo_1', [1, 2])->nullable();
            $table->enum('favorite_logo_2', [1, 2])->nullable();
            $table->enum('favorite_logo_3', [1, 2])->nullable();
            $table->enum('favorite_logo_4', [1, 2])->nullable();
            $table->string('purpose')->nullable();
            $table->string('main_color')->nullable();
            $table->string('sub_color_1')->nullable();
            $table->string('sub_color_2')->nullable();
            $table->enum('logo_color', [0, 1])->default(0)->nullable();
            $table->text('inspiration_logo')->nullable();
            $table->text('logo_file')->nullable();
            $table->string('reference_color')->nullable();
            $table->string('token')->nullable();
            $table->enum('sent_email', [0,1])->default(0)->nullable();
            $table->enum('status', [0,1])->default(0)->nullable();
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
        Schema::dropIfExists('logo_design_forms');
    }
}
