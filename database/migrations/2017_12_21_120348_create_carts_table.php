<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cookie');
            $table->integer('auth_user')->unsigned()->nullable();
            $table->decimal('subtotal', 11, 2);
            $table->decimal('discount', 11, 2);
            $table->decimal('discount_percentage', 5, 2);
            $table->integer('coupon_id')->unsigned()->nullable();
            $table->decimal('shipping_charges', 11, 2);
            $table->decimal('net_total', 11, 2);
            $table->decimal('tax', 11, 2);
            $table->decimal('total', 11, 2);
            $table->decimal('round_off', 11, 2);
            $table->decimal('payable', 11, 2);
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
        Schema::dropIfExists('carts');
    }
}
