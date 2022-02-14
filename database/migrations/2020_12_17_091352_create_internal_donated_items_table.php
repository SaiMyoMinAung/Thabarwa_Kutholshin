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
            $table->date('date');
            $table->integer('alms_round_id');
            $table->integer('item_sub_type_id');
            $table->integer('package_qty')->default(0);
            $table->integer('sacket_qty')->default(0);
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
