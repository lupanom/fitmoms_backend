<?php

namespace Tests\Feature;

use App\Models\Exercise;
use App\Models\Mother;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ExerciseProgram;

class ExerciseProgramTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_all_the_exercise_programs()
    {
        $this->withoutExceptionHandling();

        $program = ExerciseProgram::factory()->count(4)->create();

        $this->get('/api/exercise-programs')
            ->assertStatus(200)
            ->assertJsonCount(4);
    }

    /** @test */
    public function an_exercise_program_can_have_many_exercises()
    {
        $this->withoutExceptionHandling();

        $exerciseProgram = ExerciseProgram::factory()->create();

        $exerciseA = Exercise::factory()->create();

        $exerciseB = Exercise::factory()->create();

        $exerciseC = Exercise::factory()->create();

        $exerciseD = Exercise::factory()->create();

        $exerciseE = Exercise::factory()->create();

        $exerciseF = Exercise::factory()->create();

        $exerciseProgram->exercises()->attach($exerciseA);
        $exerciseProgram->exercises()->attach($exerciseB);
        $exerciseProgram->exercises()->attach($exerciseC);
        $exerciseProgram->exercises()->attach($exerciseD);
        $exerciseProgram->exercises()->attach($exerciseE);
        $exerciseProgram->exercises()->attach($exerciseF);

        $this->assertEquals(6, $exerciseProgram->exercises->count());
    }

    /** @test */
    public function it_returns_a_sorting_score()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $mother = Mother::factory()->create([
            'user_id' => $user->id,
            'is_pregnant' => true,
            'pregnancy_months' => 4,
        ]);

        $this->actingAs($user);

        $exerciseProgram = ExerciseProgram::factory()->create();

        $this->assertEquals(0, $exerciseProgram->getSortingScoreAttribute());

        $exerciseProgram = ExerciseProgram::factory()->create([
            'is_pregnant' => true,
        ]);

        $this->assertEquals(2, $exerciseProgram->getSortingScoreAttribute());
    }

    /** @test */
    public function if_a_mom_is_logged_in_the_exercise_programs_are_sorted_with_her_data()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $mother = Mother::factory()->create([
            'user_id' => $user->id,
            'is_pregnant' => true,
            'pregnancy_months' => 4,
        ]);

        $this->actingAs($user);

        $exerciseProgram = ExerciseProgram::factory()->create();

        $exerciseProgram = ExerciseProgram::factory()->create([
            'is_pregnant' => true,
            'start_month' => 6,
            'end_month' => 9,
        ]);

        $exerciseProgram = ExerciseProgram::factory()->create([
            'is_pregnant' => true,
        ]);

        $exerciseProgram = ExerciseProgram::factory()->create([
            'is_pregnant' => true,
        ]);

        $this->get('/api/exercise-programs')
            ->assertJson([
                [
                    'id' => 3
                ],
                [
                    'id' => 4
                ],
                [
                    'id' => 2,
                ],
                [
                    'id' => 1,
                ]
            ]);
    }

    /** @test */
    public function it_returns_the_next_exercise_of_the_program()
    {
        $this->withoutExceptionHandling();

        $exerciseProgram = ExerciseProgram::factory()->create();

        $exerciseA = Exercise::factory()->create();

        $exerciseB = Exercise::factory()->create();

        $exerciseProgram->exercises()->attach($exerciseA, [
            'id_next' => $exerciseB->id,
        ]);

        $exerciseProgram->exercises()->attach($exerciseB, [
            'id_next' => null,
        ]);

        $this->get('/api/exercise-programs/'.$exerciseProgram->id .'/exercise/' .$exerciseA->id)
            ->assertStatus(200)
            ->assertJson([
                'id' => $exerciseB->id,
            ]);
    }

}
