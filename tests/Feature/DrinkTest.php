<?php

namespace Tests\Feature;

use App\Models\Day;
use App\Models\Drink;
use App\Models\Exercise;
use App\Models\Food;
use App\Models\Mother;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DrinkTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_add_a_new_drink()
    {
        $this->refreshDatabase();
        $this->withoutExceptionHandling();

        $data = [
            'name' => 'Birra',
            'cal_ml' => 43,
        ];

        $this->post('/api/drinks', $data)
            ->assertStatus(201);

        $this->assertDatabaseHas('drinks', [
            'name' => 'Birra',
            'cal_ml' => 43,
        ]);
    }

    /** @test */
    public function a_mother_can_drinks_a_drink()
    {
        $this->refreshDatabase();
        $this->withoutExceptionHandling();

        $drinks = Drink::factory()->count(5)->create();

        $mother = Mother::factory()->create();

        $ml = 200;

        $this->post('/api/mothers/'.$mother->id.'/drinks/3', ['ml' => $ml])
            ->assertStatus(200);

        $day = Day::firstwhere('date', Carbon::today());

        $this->assertDatabaseHas('drink_mother', [
            'mother_id' => $mother->id,
            'drink_id' => 3,
            'day_id' => $day->id,
        ]);
    }

    /** @test */
    public function when_a_mother_drinks_a_drink_her_today_cal_are_updated()
    {
        $this->refreshDatabase();
        $this->withoutExceptionHandling();

        $drinks = Drink::factory()->count(5)->create();

        $mother = Mother::factory()->create();

        $day = Day::factory()->create([
            'mother_id' => $mother->id,
            'taken_cal' => 1500,
        ]);

        $ml = 200;

        $this->post('/api/mothers/'.$mother->id.'/drinks/3', ['ml' => $ml])
            ->assertStatus(200);

        $day->refresh();

        $this->assertEquals(1586, $day->taken_cal);

    }

    /** @test */
    public function it_returns_all_the_drinks_a_mother_drunk()
    {
        $this->refreshDatabase();
        $this->withoutExceptionHandling();

        $mother = Mother::factory()->create();

        $drinkA = Drink::factory()->create();

        $ml = 800;

        $this->post('/api/mothers/'.$mother->id.'/drinks/'.$drinkA->id, ['ml'=>$ml])
            ->assertStatus(200);

        $this->assertDatabaseHas('drink_mother', [
            'mother_id' => $mother->id,
            'drink_id' => $drinkA->id,
            'day_id' => 1,
        ]);

        $drinkB = Drink::factory()->create();

        $this->post('/api/mothers/'.$mother->id.'/drinks/'.$drinkB->id, ['ml'=>$ml])
            ->assertStatus(200);

        $this->assertDatabaseHas('drink_mother', [
            'mother_id' => $mother->id,
            'drink_id' => $drinkB->id,
            'day_id' => 1,
        ]);

        $this->get('/api/mothers/'.$mother->id.'/drinks')
            ->assertStatus(200)
            ->assertJsonCount(2);
    }

    /** @test */
    public function it_returns_all_the_exercises_a_mother_did_today()
    {
        $this->refreshDatabase();
        $this->withoutExceptionHandling();

        $mother = Mother::factory()->create();

        $drinkA = Drink::factory()->create();

        $drinkB = Drink::factory()->create();

        $drinkC = Drink::factory()->create();

        $drinkD = Drink::factory()->create();

        $drinkE = Drink::factory()->create();

        $drinkF = Drink::factory()->create();

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

        $mother->drinks()->attach($drinkA, [
            'day_id' => $dayA->id,
            'ml' => 600,
        ]);

        $mother->drinks()->attach($drinkB, [
            'day_id' => $dayB->id,
            'ml' => 600,
        ]);

        $mother->drinks()->attach($drinkC, [
            'day_id' => $dayC->id,
            'ml' => 600,
        ]);

        $mother->drinks()->attach($drinkD, [
            'day_id' => $dayD->id,
            'ml' => 600,
        ]);

        $mother->drinks()->attach($drinkE, [
            'day_id' => $dayD->id,
            'ml' => 600,
        ]);

        $mother->drinks()->attach($drinkF, [
            'day_id' => $dayD->id,
            'ml' => 600,
        ]);

        $this->get('/api/mothers/1/drinks?date=2021-01-31')
            ->assertStatus(200)
            ->assertJsonCount(3);
    }

    /** @test */
    public function it_returns_all_the_drinks_and_food_of_a_day()
    {
        $this->refreshDatabase();
        $this->withoutExceptionHandling();

        $mother = Mother::factory()->create();

        $drinkA = Drink::factory()->create();

        $drinkB = Drink::factory()->create();

        $drinkC = Drink::factory()->create();

        $drinkD = Drink::factory()->create();

        $drinkE = Drink::factory()->create();

        $drinkF = Drink::factory()->create();

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

        $mother->drinks()->attach($drinkA, [
            'day_id' => $dayA->id,
            'ml' => 600,
        ]);

        $mother->drinks()->attach($drinkB, [
            'day_id' => $dayB->id,
            'ml' => 600,
        ]);

        $mother->drinks()->attach($drinkC, [
            'day_id' => $dayC->id,
            'ml' => 600,
        ]);

        $mother->drinks()->attach($drinkD, [
            'day_id' => $dayD->id,
            'ml' => 600,
        ]);

        $mother->drinks()->attach($drinkE, [
            'day_id' => $dayD->id,
            'ml' => 600,
        ]);

        $mother->drinks()->attach($drinkF, [
            'day_id' => $dayD->id,
            'ml' => 600,
        ]);

        $foodA = Food::factory()->create();

        $foodB = Food::factory()->create();

        $foodC = Food::factory()->create();

        $foodD = Food::factory()->create();

        $foodE = Food::factory()->create();

        $mother->food()->attach($foodA, [
            'day_id' => $dayB->id,
            'grams' => 150,
        ]);

        $mother->food()->attach($foodB, [
            'day_id' => $dayC->id,
            'grams' => 180,
        ]);

        $mother->food()->attach($foodC, [
            'day_id' => $dayD->id,
            'grams' => 200,
        ]);

        $mother->food()->attach($foodD, [
            'day_id' => $dayD->id,
            'grams' => 250,
        ]);

        $mother->food()->attach($foodE, [
            'day_id' => $dayD->id,
            'grams' => 170,
        ]);

        $this->get('/api/mothers/'.$mother->id.'/food-and-drinks?date=2021-01-05')
            ->assertStatus(200)
            ->assertJsonCount(6);


    }

    /** @test */
    public function a_mother_can_drink_twice_in_a_day_the_same_drink()
    {
        $this->refreshDatabase();
        $this->withoutExceptionHandling();

        $mother = Mother::factory()->create();

        $drink1 = Drink::create([
            'name' => 'Birra',
            // 'url_image' => asset('storage/images/food/apple_red.png'),
            //'cal_grams' => 52,
            'cal_ml' => 43,
        ]);

        $ml=300;

        $this->post('/api/mothers/'.$mother->id.'/drinks/1', ['ml' => $ml])
            ->assertStatus(200);

        $ml=400;

        $this->post('/api/mothers/'.$mother->id.'/drinks/1', ['ml' => $ml])
            ->assertStatus(200);


        $drink2 = Drink::create([
            'name' => 'Vino',
            // 'url_image' => asset('storage/images/food/apple_red.png'),
            //'cal_grams' => 52,
            'cal_ml' => 130,
        ]);

        $ml = 500;

        $this->post('/api/mothers/'.$mother->id.'/drinks/2', ['ml' => $ml])
            ->assertStatus(200);

        $ml=350;

        $this->post('/api/mothers/'.$mother->id.'/drinks/2', ['ml' => $ml])
            ->assertStatus(200);

        $this->get('/api/mothers/'.$mother->id.'/drinks?date=2021-01-05')
            ->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJson([
                [
                    'id' => 1,
                    'pivot' => [
                        'ml' => 700,
                    ]
                ],
                [
                    'id' => 2,
                    'pivot' => [
                        'ml' => 850,
                    ]
                ]
            ]);
    }
}
