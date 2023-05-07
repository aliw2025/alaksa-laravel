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
        Schema::table('customers', function (Blueprint $table) {
            
            $table->string('g1_name')->nullable();
            $table->string('g1_CNIC')->nullable();
            $table->string('g1_address')->nullable();

            $table->string('g2_name')->nullable();
            $table->string('g2_CNIC')->nullable();
            $table->string('g2_address')->nullable();
            
            $table->string('note');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            //
        });
    }
};
