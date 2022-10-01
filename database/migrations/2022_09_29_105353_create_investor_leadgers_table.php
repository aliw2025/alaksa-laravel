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


        Schema::create('investor_leadgers', function (Blueprint $table) {
            // id of the leadger
            $table->id();
            // account id of the transaction
            $table->unsignedBigInteger('account_id');
            // what type of transaction it wass
            $table->string('transaction_type');
            // id df the transaction . investor id in case of opening
            $table->unsignedBigInteger('transaction_id');
            // value of the transaction
            $table->double('value');
            // date of the transaction
            $table->date('date');
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
        Schema::dropIfExists('investor_leadgers');
    }
};
