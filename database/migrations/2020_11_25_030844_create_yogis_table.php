<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYogisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yogis', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('name')->unique();
            $table->string('phone')->unique()->nullable();
            $table->integer('ward_id');
            $table->boolean('warden_id')->default(false);
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('yogis');
    }
}
