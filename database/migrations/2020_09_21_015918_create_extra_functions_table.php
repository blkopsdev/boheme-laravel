<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_functions', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->text('description')->nullable();
            $table->text('files')->nullable();
            $table->text('examples')->nullable();
            $table->text('login_urls')->nullable();
            $table->text('login_emails')->nullable();
            $table->text('login_passwords')->nullable();
            $table->string('token')->nullable();
            $table->enum('sent_email', [0,1])->default(0)->nullable();
            $table->enum('status', [0, 1])->default(0);
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
        Schema::dropIfExists('extra_functions');
    }
}
