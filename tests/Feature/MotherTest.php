<?php

namespace Tests\Feature;

use App\Models\Mother;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MotherTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_mother_can_update_her_birthday()
    {
        $this->withoutExceptionHandling();

        $mother = Mother::factory()->create();

        $birthday='1969-04-24';

        $this->post('/api/mothers/'.$mother->id, ['birthday' => $birthday])
            ->assertStatus(200);

        $this->assertDatabaseHas('mothers', [
            'id' => $mother->id,
            'birthday' => $birthday,
        ]);
    }

    /** @test */
    public function a_mother_can_update_her_heigh()
    {
        $this->withoutExceptionHandling();

        $mother = Mother::factory()->create();

        $height=160;

        $this->post('/api/mothers/'.$mother->id, ['height' => $height])
            ->assertStatus(200);

        $this->assertDatabaseHas('mothers', [
            'id' => $mother->id,
            'height' => $height,
        ]);
    }

    /** @test */
    public function it_returns_all_the_mothers_in_the_database()
    {
        $mothers = Mother::factory()->count(3)->create();

        $this->get('/api/mothers')
            ->assertStatus(200)
            ->assertJsonCount(3);
    }
}
