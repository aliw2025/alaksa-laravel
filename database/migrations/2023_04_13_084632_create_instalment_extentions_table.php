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
        Schema::create('instalment_extentions', function (Blueprint $table) {
            
            $table->id();
            $table->integer('extention_number')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('instalment_id')->nullable();
            $table->date('previous_date')->nullable();
            $table->date('current_date')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
            $table->foreign('instalment_id')->references('id')->on('instalments')->onDelete('cascade');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instalment_extentions');
    }
};
