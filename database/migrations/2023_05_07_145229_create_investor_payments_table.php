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
        Schema::create('investor_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inv1_id')->nullable();
            $table->unsignedBigInteger('inv1_account')->nullable();
            $table->double('amount')->nullable();
            $table->unsignedBigInteger('inv2_id')->nullable();
            $table->unsignedBigInteger('inv2_account')->nullable();
            $table->date('date')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('inv1_id')->references('id')->on('investors')->onDelete('cascade');
            $table->foreign('inv2_id')->references('id')->on('investors')->onDelete('cascade');

            $table->foreign('inv1_account')->references('id')->on('chart_of_accounts')->onDelete('cascade');
            $table->foreign('inv2_account')->references('id')->on('chart_of_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investor_payments');
    }
};
