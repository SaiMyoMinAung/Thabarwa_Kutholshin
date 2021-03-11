<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('name');
            $table->string('phone')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->integer('office_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_regional_admin')->default(0);
            $table->boolean('is_super')->default(0);
            $table->integer('type_of_admin_id');
            $table->integer('first_time_login')->default(1);
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
        Schema::dropIfExists('admins');
    }
}
