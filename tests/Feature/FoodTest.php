<?php

namespace Tests\Feature;

use App\Models\Day;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\Mother;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FoodTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_all_the_food()
    {
        $this->withoutExceptionHandling();

        $food = Food::factory()->count(5)->create();

        $this->get('/api/food')
            ->assertStatus(200)
            ->assertJsonCount(5);
    }

    /** @test */
    public function it_returns_a_selected_food()
    {
        $this->withoutExceptionHandling();

        $food = Food::factory()->count(5)->create();

        $this->get('/api/food/3')
            ->assertStatus(200)
            ->assertJson([
                'id' => 3,
            ]);
    }

    /** @test */
    public function a_mother_can_eat_a_food()
    {
        $this->withoutExceptionHandling();

        $food = Food::factory()->count(5)->create();

        $mother = Mother::factory()->create();

        $grams=150;

        $this->post('/api/mothers/'.$mother->id.'/food/2', ['grams' => $grams])
            ->assertStatus(200);

        $this->assertDatabaseHas('food_mother', [
            'food_id' => 2,
            'mother_id' => 1,
            'day_id' => 1,
            'grams' => 150,
        ]);
    }

    /** @test */
    public function a_mother_can_eat_a_food_in_pieces()
    {
        $this->withoutExceptionHandling();

        $food = Food::factory()->count(5)->create();

        $mother = Mother::factory()->create();

        $pieces=3;

        $this->post('/api/mothers/'.$mother->id.'/food/2', ['pieces' => $pieces])
            ->assertStatus(200);

        $this->assertDatabaseHas('food_mother', [
            'food_id' => 2,
            'mother_id' => 1,
            'day_id' => 1,
            'pieces' => 3,
        ]);
    }

    /** @test */
    public function it_returns_all_the_food_of_a_mother()
    {
        $this->withoutExceptionHandling();

        $food = Food::factory()->count(5)->create();

        $mother = Mother::factory()->create();

        $grams=150;

        $this->post('/api/mothers/'.$mother->id.'/food/2', ['grams' => $grams])
            ->assertStatus(200);

        $grams=170;

        $this->post('/api/mothers/'.$mother->id.'/food/1', ['grams' => $grams])
            ->assertStatus(200);

        $grams=200;

        $this->post('/api/mothers/'.$mother->id.'/food/5', ['grams' => $grams])
            ->assertStatus(200);

        $grams=180;

        $this->post('/api/mothers/'.$mother->id.'/food/3', ['grams' => $grams])
            ->assertStatus(200);

        $this->get('/api/mothers/'.$mother->id.'/food')
            ->assertStatus(200)
            ->assertJsonCount(4);
    }

    /** @test */
    public function it_returns_all_the_food_a_mother_eat_in_a_day()
    {
        $this->withoutExceptionHandling();

        $mother = Mother::factory()->create();

        $foodA = Food::factory()->create();

        $foodB = Food::factory()->create();

        $foodC = Food::factory()->create();

        $foodD = Food::factory()->create();

        $foodE = Food::factory()->create();

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

        $this->get('/api/mothers/'.$mother->id.'/food?date=2021-01-05')
            ->assertStatus(200)
            ->assertJsonCount(3);
    }

    /** @test */
    public function when_a_mother_eat_a_food_the_today_cal_are_updated()
    {
        $this->withoutExceptionHandling();

        $food = Food::factory()->count(5)->create();

        $mother = Mother::factory()->create();

        $grams=150;

        $this->post('/api/mothers/'.$mother->id.'/food/2', ['grams' => $grams])
            ->assertStatus(200);

        $day = Day::firstwhere('date' , Carbon::today());

        $this->assertEquals(90, $day->taken_cal);
    }

    /** @test */
    public function when_a_mother_eat_a_food_in_pieces_the_today_cal_are_updated()
    {
        $this->withoutExceptionHandling();

        $food = Food::factory()->count(5)->create([
            'cal_grams' => null,
            'cal_piece' => 250,
        ]);

        $mother = Mother::factory()->create();

        $day = Day::factory()->create([
            'mother_id' => $mother->id,
            'taken_cal' => 800,
        ]);

        $pieces=3;

        $this->post('/api/mothers/'.$mother->id.'/food/2', ['pieces' => $pieces])
            ->assertStatus(200);

        $day = Day::firstwhere('date' , Carbon::today());

        $this->assertEquals(1550, $day->taken_cal);
    }

    /** @test */
    public function it_can_add_a_new_food()
    {
        $this->withoutExceptionHandling();

        $category = FoodCategory::factory()->create();

        $food = [
            'name' => 'mela',
            'food_category_id' => $category->id,
            'cal_grams' => 60,
        ];

        $this->post('/api/food', $food)
            ->assertStatus(201);

        $this->assertDatabaseHas('food', [
            'name' => 'mela',
            'cal_grams' => 60,
        ]);
    }

    /** @test */
    public function a_mother_can_eat_twice_in_a_day_the_same_food()
    {
        $this->withoutExceptionHandling();

        $mother = Mother::factory()->create();

        $foodMela = Food::create([
            'name' => 'Mela',
            'url_image' => asset('storage/images/food/apple_red.png'),
            //'cal_grams' => 52,
            'cal_piece' => 130,
        ]);

        $pieces=2;

        $this->post('/api/mothers/'.$mother->id.'/food/1', ['pieces' => $pieces])
            ->assertStatus(200);

        $pieces=1;

        $this->post('/api/mothers/'.$mother->id.'/food/1', ['pieces' => $pieces])
            ->assertStatus(200);


        $foodMandorla = Food::create([
            'name' => 'Mandorla',
            'url_image' => asset('storage/images/food/almond.png'),
            'cal_grams' => 593,
            //'cal_piece' =>
        ]);

        $grams = 250;

        $this->post('/api/mothers/'.$mother->id.'/food/2', ['grams' => $grams])
            ->assertStatus(200);

        $grams=180;

        $this->post('/api/mothers/'.$mother->id.'/food/2', ['grams' => $grams])
            ->assertStatus(200);

        $this->get('/api/mothers/'.$mother->id.'/food?date=2021-01-05')
            ->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJson([
                [
                    'id' => 1,
                    'pivot' => [
                        'pieces' => 3,
                    ]
                ],
                [
                    'id' => 2,
                    'pivot' => [
                        'grams' => 430,
                    ]
                ]
            ]);
    }
}
