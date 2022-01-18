<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebdesignDevsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webdesign_devs', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->string('menu_item_1')->nullable();
            $table->text('submenu_item_1')->nullable();
            $table->string('menu_item_2')->nullable();
            $table->text('submenu_item_2')->nullable();
            $table->string('menu_item_3')->nullable();
            $table->text('submenu_item_3')->nullable();
            $table->string('menu_item_4')->nullable();
            $table->text('submenu_item_4')->nullable();
            $table->string('menu_item_5')->nullable();
            $table->text('submenu_item_5')->nullable();
            $table->string('menu_item_6')->nullable();
            $table->text('submenu_item_6')->nullable();
            $table->text('menu_comment')->nullable();
            $table->text('social_links')->nullable();
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
        Schema::dropIfExists('webdesign_devs');
    }
}
