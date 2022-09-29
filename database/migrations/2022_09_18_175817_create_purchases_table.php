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
        Schema::create('purchases', function (Blueprint $table) {
            // $table->id();
            $table->unsignedBigInteger('id');
            $table->string('purchase_no')->primary();
            $table->unsignedBigInteger('investor_id');
            $table->unsignedBigInteger('store_id');
            $table->string('supplier');
            $table->date('purchase_date');
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
        Schema::dropIfExists('purchases');
    }
};
