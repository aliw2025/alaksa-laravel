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
        Schema::table('expense_payments', function (Blueprint $table) {
            
            $table->unsignedBigInteger('account_id')->after('investor_id')->nullable();
            $table->unsignedBigInteger('expense_id')->after('investor_id')->nullable();
            $table->double('transaction_expense')->after('investor_id')->nullable();

            $table->foreign('account_id')->references('id')->on('chart_of_accounts');
             $table->foreign('expense_id')->references('id')->on('expenses');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expense_payments', function (Blueprint $table) {
                
            
        });
    }
};
