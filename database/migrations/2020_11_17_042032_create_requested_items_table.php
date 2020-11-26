<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requested_items', function (Blueprint $table) {
            $table->id();
            $table->char('uuid', 50);
            $table->char('request_no', 20);
            $table->integer('donated_item_id');
            $table->integer('qty')->default(1);
            $table->integer('delivered_volunteer_id')->nullable();
            $table->boolean('is_delivering')->default(false);
            $table->boolean('is_done_delivering')->default(false);
            $table->boolean('is_complete')->default(false);
            $table->boolean('is_cancel')->default(false);
            $table->integer('status');
            $table->char('state_class', 200);
            $table->integer('requestable_id');
            $table->string('requestable_type');
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
        Schema::dropIfExists('requested_items');
    }
}
