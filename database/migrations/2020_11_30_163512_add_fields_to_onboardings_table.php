<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToOnboardingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('onboardings', function (Blueprint $table) {
            $table->string('main_color')->nullable();
            $table->string('sub_color_1')->nullable();
            $table->string('sub_color_2')->nullable();
            $table->enum('website_color', [0,1])->nullable();
            $table->enum('use_logo_color', [0, 1])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('onboardings', function (Blueprint $table) {
            //
        });
    }
}
