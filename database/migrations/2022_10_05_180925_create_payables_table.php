<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // payable is actualy payemtns
        Schema::create('payables', function (Blueprint $table) {

            $table->id();
            $table->string('payment_no');
            $table->unsignedBigInteger('investor_id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('supplier');
            $table->integer('account_type');
            $table->double('amount');
            $table->string('note')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('payment_date');
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
        Schema::dropIfExists('payables');
    }
};
