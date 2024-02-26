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
        Schema::create('expense_payments', function (Blueprint $table) {

            $table->id();
            $table->string('payment_no');
            $table->unsignedBigInteger('investor_id')->nullable();
            $table->unsignedBigInteger('head_id')->nullable();
            $table->unsignedBigInteger('sub_head_id')->nullable();
            $table->double('amount');
            $table->string('note')->nullable();
            $table->unsignedBigInteger('status')->nullable();
            $table->date('payment_date');
            $table->timestamps();
            $table->foreign('investor_id')->references('id')->on('investors')->onDelete('cascade');
            $table->foreign('head_id')->references('id')->on('expense_heads')->onDelete('cascade');
            $table->foreign('sub_head_id')->references('id')->on('sub_expense_heads')->onDelete('cascade');
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
        Schema::dropIfExists('expense_payments');
    }
};
