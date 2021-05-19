<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('paying_amount')->nullable();
            $table->string('blnc_transection')->nullable();
            $table->string('stripe_order_id')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('shipping')->nullable();
            $table->string('tax')->nullable();
            $table->string('status')->nullable()->default(0);
            $table->string('mouth')->nullable();
            $table->string('date')->nullable();
            $table->string('year')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
