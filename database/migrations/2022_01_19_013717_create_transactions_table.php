<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->decimal('purchased_items', 10, 2)->default(0);
            $table->decimal('cash_out_for_trade', 10, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0);
            $table->string('transaction_type')->nullable();
            $table->text('comments')->nullable();
            $table->decimal('purchase_total', 10, 2)->default(0);
            $table->decimal('store_credit', 10, 2)->default(0);
            $table->decimal('cash_in', 10, 2)->default(0);
            $table->decimal('cash_out_for_storecredit', 10, 2)->default(0);
            $table->string('employee')->nullable();
            $table->string('logged_in_user')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
