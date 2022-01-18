<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebdesignOnboardingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webdesign_onboardings', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->string('industry')->nullable();
            $table->text('type')->nullable();
            $table->text('usp')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_address')->nullable();
            $table->enum('font', ['Open Sans and Roboto', 'Playfair Display and Montserrat', 'Lora and Alegreya', 'Merriweather and Lato', 'Amatic SC and Josefin Slab', 'PT Sans Narrow and PT Sans'])->nullable();
            $table->text('font_description')->nullable();
            $table->enum('appeal_1', [0,1])->nullable();
            $table->enum('appeal_2', [0,1])->nullable();
            $table->enum('appeal_3', [0,1])->nullable();
            $table->enum('appeal_4', [0,1])->nullable();
            $table->text('reference')->nullable();
            $table->enum('team', [0, 1])->nullable();
            $table->enum('review', [0, 1])->nullable();
            $table->enum('portfolio', [0, 1])->nullable();
            $table->enum('blog', [0, 1])->nullable();
            $table->enum('newsletter', [0, 1])->nullable();
            $table->string('main_color')->nullable();
            $table->string('sub_color_1')->nullable();
            $table->string('sub_color_2')->nullable();
            $table->enum('website_color', [0,1])->nullable();
            $table->enum('use_logo_color', [0,1])->nullable();
            $table->string('token')->nullable();
            $table->enum('status', [0,1])->default(0)->nullable();
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
        Schema::dropIfExists('webdesign_onboardings');
    }
}
