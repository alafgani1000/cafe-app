<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCafesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cafes', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tagline');
            $table->string('alamat');
            $table->timestamps();
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->string('name');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_meja');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('name');
            $table->integer('status');
            $table->integer('price');
            $table->string('price_initial');
            $table->integer('discount');
            $table->timestamps();
        });

        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('table_id');
            $table->integer('dp');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->integer('status');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('reservation_id');
            $table->integer('total_price');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('money');
            $table->integer('return');
            $table->timestamps();
        });

        Schema::create('order_actions', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->string('action');
            $table->string('data');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('payment_actions', function (Blueprint $table) {
            $table->id();
            $table->integer('payment_id');
            $table->string('action');
            $table->integer('user_id');
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
        Schema::dropIfExists('cafes');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('tables');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('order_actions');
        Schema::dropIfExists('payment_actions');
    }
}
