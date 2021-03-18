<?php

namespace Tests\Feature;

use App\Models\ExerciseCategory;
use App\Models\ExerciseProgram;
use App\Models\Mother;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExerciseCategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_all_the_exercise_categories()
    {
        $this->withoutExceptionHandling();

        $categories = \App\Models\ExerciseCategory::factory()->count(4)->create();

        $this->get('/api/exercise-categories')
            ->assertStatus(200)
            ->assertJsonCount(4);
    }

    /** @test */
    public function it_returns_a_sorting_score()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $mother = Mother::factory()->create([
            'user_id' => $user->id,
            'is_pregnant' => false,
            'baby_months' => 4,
        ]);

        $this->actingAs($user);

        $category = ExerciseCategory::factory()->create();

        $this->assertEquals(2, $category->getSortingScoreAttribute());

        $category = ExerciseCategory::factory()->create([
            'is_pregnant' => true,
        ]);

        $this->assertEquals(0, $category->getSortingScoreAttribute());
    }

    /** @test */
    public function if_a_mom_is_logged_in_the_exercise_categories_are_sorted_with_her_data()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $mother = Mother::factory()->create([
            'user_id' => $user->id,
            'is_pregnant' => true,
            'pregnancy_months' => 4,
        ]);

        $category = ExerciseCategory::factory()->create();

        $category = ExerciseCategory::factory()->create([
            'is_pregnant' => true,
            'start_month' => 6,
            'end_month' => 9,
        ]);

        $category = ExerciseCategory::factory()->create([
            'is_pregnant' => true,
        ]);

        $category = ExerciseCategory::factory()->create([
            'is_pregnant' => true,
        ]);

        $this->get('/api/exercise-categories/mother/'.$mother->id)
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
}
