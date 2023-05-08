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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedBigInteger('user_id')->nullable();  
            $table->double('amount'); 
            $table->unsignedBigInteger('investor_id')->nullable();  
            $table->unsignedBigInteger('head_id')->nullable();
            $table->unsignedBigInteger('sub_head_id')->nullable();
            $table->date('date');
            $table->timestamps();

            $table->foreign('head_id')->references('id')->on('expense_heads')->onDelete('cascade');
            $table->foreign('sub_head_id')->references('id')->on('sub_expense_heads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
};
