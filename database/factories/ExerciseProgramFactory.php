<?php

namespace Database\Factories;

use App\Models\ExerciseProgram;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExerciseProgramFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExerciseProgram::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Addominali',
            'description' => 'Allenamento addominale post-parto',
            'is_pregnant' => false,
            'start_month' => 2,
            'end_month' => 4,
        ];
    }
}
