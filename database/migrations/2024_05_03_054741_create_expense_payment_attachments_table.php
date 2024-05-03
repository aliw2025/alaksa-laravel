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
        Schema::create('expense_payment_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('db_name')->nullable();
            $table->unsignedBigInteger('expense_payment_id');
            $table->string('name')->nullable();
            $table->string('file_path')->nullable();
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
        Schema::dropIfExists('expense_payment_attachments');
    }
};
