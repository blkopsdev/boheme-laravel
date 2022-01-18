<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnboardingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onboardings', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->enum('status', [0, 1])->default(0);
            $table->enum('purpose', [0, 1, 2, 3])->default(0);
            $table->text('purpose_comment')->nullable();
            $table->enum('focus', [0, 1, 2, 3, 4])->default(0);
            $table->text('focus_comment')->nullable();
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
            $table->string('logo_name')->nullable();
            $table->enum('has_domain', [0, 1, 2])->default(0)->nullable();
            $table->string('domain_name')->nullable();
            $table->string('domain_provider')->nullable();
            $table->string('domain_username')->nullable();
            $table->string('domain_password')->nullable();
            $table->text('ref_websites')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->enum('layout', [0, 1, 2, 3, 4, 5, 6, 7, 8, 9])->default(0)->nullable();
            $table->text('layout_comment')->nullable();
            $table->enum('image_source', [0, 1, 2])->default(0)->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_mail')->nullable();
            $table->string('contact_address')->nullable();
            $table->text('social')->nullable();
            $table->text('social_links')->nullable();
            $table->string('token')->nullable();
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
        Schema::dropIfExists('onboardings');
    }
}
