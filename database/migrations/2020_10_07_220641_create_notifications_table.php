<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->enum('type', [0, 1, 2, 3, 4, 5])->default(0);
            $table->integer('status_id')->nullable();
            $table->enum('is_read', [0, 1])->default(0);
            $table->enum('quick_view', [0, 1])->default(0);
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
        Schema::dropIfExists('notifications');
    }
}
