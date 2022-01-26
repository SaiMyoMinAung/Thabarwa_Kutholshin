<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContributionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contribution_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contribution_id');
            $table->unsignedBigInteger('item_sub_type_id');
            $table->unsignedBigInteger('share_internal_donated_item_id')->nullable();
            $table->integer('sacket_qty');
            $table->integer('is_accepted')->default(0);
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
        Schema::dropIfExists('contribution_items');
    }
}
