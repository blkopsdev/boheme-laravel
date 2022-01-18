<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_mails', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->enum('mail_type', [0,1,2])->default(0);
            $table->text('mails')->nullable();
            $table->string('mail_first_name')->nullable();
            $table->string('mail_last_name')->nullable();
            $table->string('mail_title')->nullable();
            $table->string('mail_phone')->nullable();
            $table->string('mail_personal_email')->nullable();
            $table->string('mail_address')->nullable();
            $table->string('mail_zip')->nullable();
            $table->string('mail_state')->nullable();
            $table->string('mail_country')->nullable();
            $table->string('mail_kvk')->nullable();
            $table->enum('mail_fee', [0, 1])->default(0);
            $table->enum('has_domain', [0, 1, 2])->default(0);
            $table->string('domain_name')->nullable();
            $table->string('domain_provider')->nullable();
            $table->string('domain_username')->nullable();
            $table->string('domain_password')->nullable();
            $table->enum('sent_email', [0,1])->default(0)->nullable();
            $table->enum('status', [0,1])->default(0)->nullable();
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
        Schema::dropIfExists('business_mails');
    }
}
