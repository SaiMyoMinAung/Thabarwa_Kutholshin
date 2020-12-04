<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_records', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->char('sr_no', 100);
            $table->char('certificate_no', 50);
            $table->char('main_donor_name', 50);
            $table->date('date_of_donation');
            $table->integer('donation_cash');
            $table->integer('estimate_cost');
            $table->smallInteger('type_of_money');
            $table->mediumText('donation_material');
            $table->mediumText('donor');
            $table->mediumInteger('record_by');
            $table->smallInteger('kind_of_donation_id');
            $table->smallInteger('center_id');
            $table->softDeletes();
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
        Schema::dropIfExists('donation_records');
    }
}
