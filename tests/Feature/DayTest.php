<?php

namespace Tests\Feature;

use App\Models\Day;
use App\Models\Mother;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DayTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_all_the_days_of_a_mother()
    {
        $this->withoutExceptionHandling();

        $mother = Mother::factory()->create();

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

        $this->get('/api/mothers/'.$mother->id.'/days')
            ->assertStatus(200)
            ->assertJsonCount(4);
    }

    /** @test */
    public function it_returns_the_last_week_days()
    {
        $this->withoutExceptionHandling();

        $mother = Mother::factory()->create();

        $dayA = Day::factory()->create([
            'date' => Carbon::today()->subDays(8),
            'mother_id' => $mother->id,
        ]);

        $dayB = Day::factory()->create([
            'date' => Carbon::today()->subDays(7),
            'mother_id' => $mother->id,
        ]);

        $dayC = Day::factory()->create([
            'date' => Carbon::today()->subDays(6),
            'mother_id' => $mother->id,
        ]);

        $dayD = Day::factory()->create([
            'date' => Carbon::today()->subDays(5),
            'mother_id' => $mother->id,
        ]);

        $dayA = Day::factory()->create([
            'date' => Carbon::today()->subDays(4),
            'mother_id' => $mother->id,
        ]);

        $dayB = Day::factory()->create([
            'date' => Carbon::today()->subDays(3),
            'mother_id' => $mother->id,
        ]);

        $dayC = Day::factory()->create([
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

        $response = $this->get('/api/mothers/'.$mother->id.'/week')
            ->assertStatus(200)
            ->assertJsonCount(7);

        $this->assertTrue(json_decode($response->content())[0]->date > json_decode($response->content())[1]);

    }

    /** @test */
    public function it_returns_the_last_month_days()
    {
        $this->withoutExceptionHandling();

        $mother = Mother::factory()->create();

        $dayA = Day::factory()->create([
            'date' => Carbon::today()->subDays(32),
            'mother_id' => $mother->id,
        ]);

        $dayB = Day::factory()->create([
            'date' => Carbon::today()->subDays(31),
            'mother_id' => $mother->id,
        ]);

        $dayC = Day::factory()->create([
            'date' => Carbon::today()->subDays(30),
            'mother_id' => $mother->id,
        ]);

        $dayD = Day::factory()->create([
            'date' => Carbon::today()->subDays(29),
            'mother_id' => $mother->id,
        ]);

        $dayA = Day::factory()->create([
            'date' => Carbon::today()->subDays(28),
            'mother_id' => $mother->id,
        ]);

        $dayB = Day::factory()->create([
            'date' => Carbon::today()->subDays(27),
            'mother_id' => $mother->id,
        ]);

        $dayC = Day::factory()->create([
            'date' => Carbon::today()->subDays(26),
            'mother_id' => $mother->id,
        ]);

        $dayC = Day::factory()->create([
            'date' => Carbon::today()->subDays(25),
            'mother_id' => $mother->id,
        ]);

        $dayA = Day::factory()->create([
            'date' => Carbon::today()->subDays(24),
            'mother_id' => $mother->id,
        ]);

        $dayB = Day::factory()->create([
            'date' => Carbon::today()->subDays(23),
            'mother_id' => $mother->id,
        ]);

        $dayC = Day::factory()->create([
            'date' => Carbon::today()->subDays(22),
            'mother_id' => $mother->id,
        ]);

        $dayD = Day::factory()->create([
            'date' => Carbon::today()->subDays(21),
            'mother_id' => $mother->id,
        ]);

        $dayA = Day::factory()->create([
            'date' => Carbon::today()->subDays(20),
            'mother_id' => $mother->id,
        ]);

        $dayB = Day::factory()->create([
            'date' => Carbon::today()->subDays(19),
            'mother_id' => $mother->id,
        ]);

        $dayC = Day::factory()->create([
            'date' => Carbon::today()->subDays(18),
            'mother_id' => $mother->id,
        ]);

        $dayC = Day::factory()->create([
            'date' => Carbon::today()->subDays(17),
            'mother_id' => $mother->id,
        ]);
        $dayA = Day::factory()->create([
            'date' => Carbon::today()->subDays(16),
            'mother_id' => $mother->id,
        ]);

        $dayB = Day::factory()->create([
            'date' => Carbon::today()->subDays(15),
            'mother_id' => $mother->id,
        ]);

        $dayC = Day::factory()->create([
            'date' => Carbon::today()->subDays(14),
            'mother_id' => $mother->id,
        ]);

        $dayD = Day::factory()->create([
            'date' => Carbon::today()->subDays(13),
            'mother_id' => $mother->id,
        ]);

        $dayA = Day::factory()->create([
            'date' => Carbon::today()->subDays(12),
            'mother_id' => $mother->id,
        ]);

        $dayB = Day::factory()->create([
            'date' => Carbon::today()->subDays(11),
            'mother_id' => $mother->id,
        ]);

        $dayC = Day::factory()->create([
            'date' => Carbon::today()->subDays(10),
            'mother_id' => $mother->id,
        ]);

        $dayC = Day::factory()->create([
            'date' => Carbon::today()->subDays(9),
            'mother_id' => $mother->id,
        ]);
        $dayA = Day::factory()->create([
            'date' => Carbon::today()->subDays(8),
            'mother_id' => $mother->id,
        ]);

        $dayB = Day::factory()->create([
            'date' => Carbon::today()->subDays(7),
            'mother_id' => $mother->id,
        ]);

        $dayC = Day::factory()->create([
            'date' => Carbon::today()->subDays(6),
            'mother_id' => $mother->id,
        ]);

        $dayD = Day::factory()->create([
            'date' => Carbon::today()->subDays(5),
            'mother_id' => $mother->id,
        ]);

        $dayA = Day::factory()->create([
            'date' => Carbon::today()->subDays(4),
            'mother_id' => $mother->id,
        ]);

        $dayB = Day::factory()->create([
            'date' => Carbon::today()->subDays(3),
            'mother_id' => $mother->id,
        ]);

        $dayC = Day::factory()->create([
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

        $response = $this->get('/api/mothers/'.$mother->id.'/month')
            ->assertStatus(200)
            ->assertJsonCount(30);

        $this->assertTrue(json_decode($response->content())[0]->date < json_decode($response->content())[1]);

    }

}
