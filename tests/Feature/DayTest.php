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
}
