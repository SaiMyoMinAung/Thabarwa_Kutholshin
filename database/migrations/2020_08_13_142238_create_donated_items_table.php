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
            $table->char('uuid', 50)->unique();
            $table->char('item_unique_id', 10)->unique();
            $table->char('about_item', 100);
            $table->char('donor_name', 100);
            $table->char('phone', 50);
            $table->date('pickedup_at');
            $table->string('pickedup_info');
            $table->text('remark')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->string('delivered_info')->nullable();
            $table->integer('qty')->default(1);
            $table->integer('estimate_cost')->default(0);

            $table->integer('office_id')->nullable();

            $table->integer('kind_of_item');
            $table->integer('item_type_id')->nullable();

            $table->integer('country_id')->nullable();
            $table->integer('state_region_id')->nullable();
            $table->integer('city_id')->nullable();

            $table->integer('store_id')->nullable();
            $table->integer('box_id')->nullable();

            $table->integer('donated_user_id')->nullable();
            $table->integer('pickedup_volunteer_id')->nullable();
            $table->integer('store_keeper_volunteer_id')->nullable();
            $table->integer('repaired_volunteer_id')->nullable();

            $table->integer('status');
            $table->char('state_class', 50);

            $table->boolean('is_confirmed_by_donor')->default(0);
            $table->boolean('is_pickingup')->default(0);
            $table->boolean('is_done_pickingup')->default(0);
            $table->boolean('is_storing')->default(0);
            $table->boolean('is_done_storing')->default(0);
            $table->boolean('is_required_repairing')->default(1);
            $table->boolean('is_repairing')->default(0);
            $table->boolean('is_done_repairing')->default(0);
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
