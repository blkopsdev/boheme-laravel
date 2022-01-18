<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('files')->nullable();
            $table->integer('manager_id')->nullbale();
            $table->enum('type', [0, 1])->default(0)->nullable();
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->date('deadline')->nullable();
            $table->integer('calendar_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->enum('status', [0, 1])->default(0)->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('todo_lists');
    }
}
