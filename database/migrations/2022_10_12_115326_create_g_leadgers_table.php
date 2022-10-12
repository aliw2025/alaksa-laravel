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
        Schema::create('g_leadgers', function (Blueprint $table) {

            $table->id();
            // account id of the transaction
            $table->unsignedBigInteger('account_id');
            //  this transaction id create transaction_id and transaction_type
            $table->morphs('transaction');
            // value of the transaction
            $table->double('value');
            // date of the transaction
            $table->date('date');
            //  time stams for info
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
        Schema::dropIfExists('g_leadgers');
    }
};
