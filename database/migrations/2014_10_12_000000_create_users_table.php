<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->string('phonenumber')->nullable();
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('role')->default('customer');
            $table->string('email')->unique();
            $table->date('dob')->nullable();
            $table->string('profile_id')->nullable();
            $table->string('status')->default('active');
            $table->string('seeking_id')->nullable();
            $table->string('motive_id')->nullable();
            $table->string('avatar')->default('default.jpg');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
