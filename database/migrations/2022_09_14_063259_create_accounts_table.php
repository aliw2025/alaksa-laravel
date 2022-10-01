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
        Schema::create('accounts', function (Blueprint $table) {

            $table->id();
            // name of the account
            $table->string('account_name');
            //  cash asset payable etc
            $table->unsignedBigInteger('account_type');
            // owner of the account
            $table->unsignedBigInteger('owner');
            // opening balance of the account
            $table->double('opening_balance');
            // creating forieng key constraints
            $table->foreign('owner')->references('id')->on('investors');
            // time stamps
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
        Schema::dropIfExists('accounts');
    }
};
