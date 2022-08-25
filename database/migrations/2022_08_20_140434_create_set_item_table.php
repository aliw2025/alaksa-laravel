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
        Schema::create('set_items', function (Blueprint $table) {
            // $table->id();
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('set_id');
            $table->foreign('set_id')->references('id')->on('sets');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items');
            $table->timestamps();
            $table->primary(['set_id', 'item_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('set_item');
    }
};
