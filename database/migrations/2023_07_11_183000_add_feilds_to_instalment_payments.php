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
        Schema::table('instalment_payments', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('status')->after('amount')->nullable();
            $table->unsignedBigInteger('account_id')->after('amount')->nullable();

            $table->foreign('status')->references('id')->on('transaction_statuses')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('chart_of_accounts')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instalment_payments', function (Blueprint $table) {
            //
        });
    }
};
