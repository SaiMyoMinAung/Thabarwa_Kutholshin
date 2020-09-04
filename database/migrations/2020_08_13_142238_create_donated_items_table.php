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
            $table->string('about_item');
            $table->timestamp('pickedup_at');
            $table->string('pickedup_info');
            $table->integer('donor_id');
            $table->integer('status')->nullable();
            $table->integer('item_type_id')->nullable();
            $table->integer('state_region_id')->nullable();
            $table->text('remark')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->string('delivered_info')->nullable();
            $table->integer('store_id')->nullable();
            $table->integer('receiver_id')->nullable();
            $table->integer('item_unique_id')->nullable();
            $table->integer('pickedup_driver_id')->nullable();
            $table->integer('delivered_driver_id')->nullable();
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
        Schema::dropIfExists('donated_items');
    }
}
