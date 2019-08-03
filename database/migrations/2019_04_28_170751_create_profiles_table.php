<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->nullable();
            $table->string('country_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('hair_color_id')->nullable();
            $table->string('hair_length_id')->nullable();
            $table->string('hair_type_id')->nullable();
            $table->string('eye_color_id')->nullable();
            $table->string('eye_wear_id')->nullable();
            $table->string('height_id')->nullable();
            $table->string('facial_hair_type_id')->nullable();
            $table->string('weight_id')->nullable();
            $table->string('body_type_id')->nullable();
            $table->string('ethnicity_id')->nullable();
            $table->string('complexion_id')->nullable();
            $table->string('best_feature_id')->nullable();
            $table->string('body_art_id')->nullable();
            $table->string('beauty_level_id')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
