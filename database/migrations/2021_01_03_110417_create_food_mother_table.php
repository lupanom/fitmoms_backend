<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodMotherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_mother', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('mother_id');
            $table->bigInteger('food_id');
            $table->bigInteger('day_id');
            $table->integer('grams')->nullable();
            $table->integer('pieces')->nullable();
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
        Schema::dropIfExists('food_mother');
    }
}
