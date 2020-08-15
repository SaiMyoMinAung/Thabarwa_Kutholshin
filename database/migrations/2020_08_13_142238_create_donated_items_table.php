<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonatedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donated_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('pickedup_at', 0);
            $table->string('pickedup_info');
            $table->integer('status');
            $table->timestamp('delivered_at', 0)->nullable();
            $table->string('delivered_info');
            $table->text('remark');
            $table->integer('donor_id');
            $table->integer('item_type_id');
            $table->integer('state_region_id');
            $table->integer('store_id')->nullable();
            $table->integer('receiver_id')->nullable();
            $table->integer('item_unique_id')->nullable();
            $table->integer('pickedup_driver_id')->nullable();
            $table->integer('delivered_driver_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donated_items');
    }
}
