<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContributionInternalDonatedItemHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contribution_internal_donated_item_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contribution_id');
            $table->integer('internal_donated_item_id');
            $table->boolean('is_confirmed')->default(0);
            $table->boolean('is_accepted')->default(0);
            $table->foreign('contribution_id', 'contribution_id_foreign')->references('id')->on('contributions')->onDelete('CASCADE');
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
        Schema::dropIfExists('contribution_internal_donated_item_histories');
    }
}
