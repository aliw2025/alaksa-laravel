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
            $table->id();
            $table->unsignedBigInteger('investor_id');
            $table->string('transaction_type');
            $table->unsignedBigInteger('transaction_id');
            $table->float('value');
            $table->date('date');
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
