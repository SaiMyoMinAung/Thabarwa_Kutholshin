<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalRequestedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_requested_items', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->integer('internal_donated_item_id');
            $table->integer('package_qty')->default(1);
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
        Schema::dropIfExists('internal_requested_items');
    }
}
