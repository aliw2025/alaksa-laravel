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
        //
      
        Schema::table('purchases', function (Blueprint $table) {
           
            $table->foreign('supplier')->references('id')->on('suppliers')->onDelete('restrict');
           
        });

        Schema::table('supplier_payments', function (Blueprint $table) {
           
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('restrict');
           
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
