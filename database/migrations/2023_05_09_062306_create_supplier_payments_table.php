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
        Schema::create('supplier_payments', function (Blueprint $table) {
            
            $table->id();
            $table->string('payment_no');
            $table->unsignedBigInteger('investor_id')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->double('amount');
            $table->string('note')->nullable();
            $table->unsignedBigInteger('status')->nullable();
            $table->date('payment_date');
            $table->timestamps();

            $table->foreign('investor_id')->references('id')->on('investors')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('status')->references('id')->on('transaction_statuses')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_payments');
    }
};
