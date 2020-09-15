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
            $table->string('uuid');
            $table->integer('item_unique_id')->nullable();
            $table->string('about_item');
            $table->date('pickedup_at');
            $table->string('pickedup_info');

            $table->integer('item_type_id')->nullable();
            $table->integer('state_region_id')->nullable();
            $table->text('remark')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->string('delivered_info')->nullable();

            $table->integer('donor_id');
            $table->integer('store_id')->nullable();
            $table->integer('receiver_id')->nullable();
            $table->integer('pickedup_driver_id')->nullable();
            $table->integer('delivered_driver_id')->nullable();

            $table->string('status')->default('pending');
            $table->string('state_class')->default('App\\\State\\\PendingState');
            $table->boolean('is_confirm_by_donor')->default(0);
            $table->boolean('is_pickingup')->default(0);
            $table->boolean('is_arrive_at_office')->default(0);
            $table->boolean('is_need_repairing')->default(0);
            $table->boolean('is_repairing')->default(0);
            $table->boolean('is_repairing_finish')->default(0);
            $table->boolean('is_deliver')->default(0);
            $table->boolean('is_complete')->default(0);

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
