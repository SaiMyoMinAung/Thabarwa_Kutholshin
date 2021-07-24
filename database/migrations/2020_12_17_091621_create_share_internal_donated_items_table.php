<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareInternalDonatedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('share_internal_donated_items', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->date('date');
            $table->integer('item_type_id');
            $table->integer('item_sub_type_id');
            $table->integer('socket_qty')->default(1);
            $table->integer('requestable_id');
            $table->string('requestable_type');
            $table->integer('admin_id');
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
        Schema::dropIfExists('share_internal_donated_items');
    }
}
