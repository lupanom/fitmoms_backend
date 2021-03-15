<?php

namespace Database\Factories;

use App\Models\Exercise;
use App\Models\ExerciseCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExerciseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exercise::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Candela',
            'description' => 'Posizione supina con glutei sollevati da terra e gomiti piegati a sorreggerli',
            'exercise_seconds' => '90',
            'exercise_category_id' => ExerciseCategory::factory()->create(),
            'repetitions' => 3,
            'cal_burned' => 200
        ];
    }
}
