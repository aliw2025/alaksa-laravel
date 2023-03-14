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
        Schema::create('transfer_requests', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('sender_account_id')->nullable();
            $table->double('amount')->nullable();
            $table->unsignedBigInteger('reciever_account_id')->nullable();
            $table->unsignedBigInteger('status')->nullable();
            $table->unsignedBigInteger('owner_investor_id')->nullable();
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
        Schema::dropIfExists('transfer_requests');
    }
};
