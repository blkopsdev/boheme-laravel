<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('logo')->nullable();
            $table->string('main_color')->nullable();
            $table->string('sub_color')->nullable();
            $table->string('other_color')->nullable();
            // $table->string('smtp_host')->nullable();
            // $table->string('smtp_port')->nullable();
            // $table->string('smtp_username')->nullable();
            // $table->string('smtp_password')->nullable();
            // $table->string('smtp_encryption')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
