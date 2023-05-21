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
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedBigInteger('user_id')->nullable();  
            $table->double('amount')->nullable(); 
            $table->unsignedBigInteger('investor_id')->nullable();  
            $table->unsignedBigInteger('status');
            $table->date('date');
            $table->timestamps();
            
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
        Schema::dropIfExists('investments');
    }
};
