<?php

namespace Tests\Feature;

use App\Models\Day;
use App\Models\Exercise;
use App\Models\ExerciseCategory;
use App\Models\Mother;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExerciseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_all_the_exercises()
    {
        $this->withoutExceptionHandling();

        $exercises = Exercise::factory()->count(6)->create();

        $this->get('/api/exercises')
            ->assertStatus(200)
            ->assertJsonCount(6);
    }

    /** @test */
    public function it_returns_the_selected_exercise()
    {
        $this->withoutExceptionHandling();

        $exercises = Exercise::factory()->count(6)->create();

        $this->get('/api/exercises/4')
            ->assertStatus(200)
            ->assertJson([
                'id' => 4,
            ]);
    }

    /** @test */
    public function a_mother_can_do_an_exercise()
    {
        $this->withoutExceptionHandling();

        $mother = Mother::factory()->create();

        $exercise = Exercise::factory()->create();

        $day = Day::factory()->create([
            'mother_id' => $mother->id,
        ]);

        $this->get('/api/mothers/'.$mother->id.'/exercises/'.$exercise->id)
            ->assertStatus(200);

        $this->assertDatabaseHas('exercise_mother', [
            'mother_id' => $mother->id,
            'exercise_id' => $exercise->id,
            'day_id' => $day->id,
        ]);
    }

    /** @test */
    public function it_returns_all_the_exercises_a_mother_did()
    {
        $this->withoutExceptionHandling();

        $mother = Mother::factory()->create();

        $exerciseA = Exercise::factory()->create();

        $this->post('/api/mothers/'.$mother->id.'/exercises/'.$exerciseA->id)
            ->assertStatus(200);

        $this->assertDatabaseHas('exercise_mother', [
            'mother_id' => $mother->id,
            'exercise_id' => $exerciseA->id,
            'day_id' => 1,
        ]);

        $exerciseB = Exercise::factory()->create();

        $this->post('/api/mothers/'.$mother->id.'/exercises/'.$exerciseB->id)
            ->assertStatus(200);

        $this->assertDatabaseHas('exercise_mother', [
            'mother_id' => $mother->id,
            'exercise_id' => $exerciseB->id,
            'day_id' => 1,
        ]);

        $this->get('/api/mothers/'.$mother->id.'/exercises')
            ->assertStatus(200)
            ->assertJsonCount(2);
    }

    /** @test */
    public function it_returns_all_the_exercises_a_mother_did_today()
    {
        $this->withoutExceptionHandling();

        $mother = Mother::factory()->create();

        $exerciseA = Exercise::factory()->create();

        $exerciseB = Exercise::factory()->create();

        $exerciseC = Exercise::factory()->create();

        $exerciseD = Exercise::factory()->create();

        $exerciseE = Exercise::factory()->create();

        $exerciseF = Exercise::factory()->create();

        $dayA = Day::factory()->create([
            'date' => Carbon::today()->subDays(3),
            'mother_id' => $mother->id,
        ]);

        $dayB = Day::factory()->create([
            'date' => Carbon::today()->subDays(2),
            'mother_id' => $mother->id,
        ]);

        $dayC = Day::factory()->create([
            'date' => Carbon::today()->subDays(1),
            'mother_id' => $mother->id,
        ]);

        $dayD = Day::factory()->create([
            'mother_id' => $mother->id,
        ]);

        $mother->exercises()->attach($exerciseA, [
            'day_id' => $dayA->id,
        ]);

        $mother->exercises()->attach($exerciseB, [
            'day_id' => $dayB->id,
        ]);

        $mother->exercises()->attach($exerciseC, [
            'day_id' => $dayC->id,
        ]);

        $mother->exercises()->attach($exerciseD, [
            'day_id' => $dayD->id,
        ]);

        $mother->exercises()->attach($exerciseE, [
            'day_id' => $dayD->id,
        ]);

        $mother->exercises()->attach($exerciseF, [
            'day_id' => $dayD->id,
        ]);


        $this->get('/api/mothers/1/exercises?date=2021-01-05')
            ->assertStatus(200)
            ->assertJsonCount(3);
    }
}
