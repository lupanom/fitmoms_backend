<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('exercise_seconds');
            $table->integer('break_seconds')->nullable();
            $table->bigInteger('exercise_category_id');
            $table->integer('repetitions');
            $table->integer('cal_burned');
            $table->string('url_video')->nullable();
            $table->string('url_cover_video')->nullable();
            $table->string('url_cover_square')->nullable();
            $table->boolean('ended')->default(false);
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
        Schema::dropIfExists('exercises');
    }
}
