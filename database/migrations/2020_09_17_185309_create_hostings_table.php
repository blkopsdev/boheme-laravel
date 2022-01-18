<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostings', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->enum('hosting', [0, 1, 2])->default(0);
            $table->enum('status', [0, 1])->default(0);
            $table->enum('type', [0, 1, 2, 3])->nullable();
            $table->string('bank_info')->nullable();
            $table->string('tav')->nullable();
            $table->enum('agree_terms', [0, 1])->default(0)->nullable();
            $table->enum('agree_fee', [0, 1])->default(0)->nullable();
            $table->enum('have_site', [0, 1])->default(0);
            $table->string('wp_url')->nullable();
            $table->string('wp_username')->nullable();
            $table->string('wp_password')->nullable();
            $table->enum('aware_cost', [0, 1])->nullable();
            $table->string('domain_name')->nullable();
            $table->string('domain_provider')->nullable();
            $table->string('domain_username')->nullable();
            $table->string('domain_password')->nullable();
            $table->enum('google_analytics', [0, 1])->nullable();
            $table->string('gmail_account')->nullable();
            $table->enum('sent_email', [0,1])->default(0)->nullable();
            $table->string('token')->nullable();
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
        Schema::dropIfExists('hostings');
    }
}
