<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebdesignFirstVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webdesign_first_versions', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->text('feedback')->nullable();
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
        Schema::dropIfExists('webdesign_first_versions');
    }
}
