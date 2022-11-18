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
        Schema::create('sales', function (Blueprint $table) {

            $table->id();
            $table->string('invoice_no');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('rec_of_id')->nullable();
            $table->unsignedBigInteger('mar_of_id')->nullable();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('investor_id');
            $table->unsignedBigInteger('status')->nullable();
            $table->integer('plan')->nullable();
            $table->double('markup')->nullable();
            $table->double('selling_price')->nullable();
            $table->integer('sale_type')->nullable();
            $table->double('total');
            $table->date('sale_date');
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
