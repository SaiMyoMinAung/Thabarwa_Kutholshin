<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalDonatedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_donated_items', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->char('item_unique_id', 10)->unique();
            $table->integer('alms_round_id');
            $table->integer('item_type_id');
            $table->integer('item_sub_type_id');
            $table->integer('package_qty')->default(1);
            $table->integer('socket_qty')->default(1);
            $table->mediumInteger('socket_per_package')->default(1);
            $table->smallInteger('unit_id');
            $table->text('remark');
            $table->smallInteger('status');
            $table->boolean('is_confirmed');
            $table->integer('office_id');
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
        Schema::dropIfExists('internal_donated_items');
    }
}
