<?php

namespace Tests\Feature;

use App\Models\Mother;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_register_herself()
    {
        $this->withoutExceptionHandling();

        $user = [
            'name' => 'Mara',
            'email' => 'mara@prova.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->get('/sanctum/register?name=Mara&email=mara@prova.it&password=password&password_confirmation=password')
            ->assertStatus(200);

        $this->assertNotNull(json_decode($response->content())->token);
        $this->assertNotEmpty(json_decode($response->content())->token);

        $this->assertDatabaseHas('users', [
            'email' => 'mara@prova.it'
        ]);
    }

    /** @test */
    public function when_a_user_register_herself_a_mother_is_created()
    {
        $this->withoutExceptionHandling();

        $user = [
            'name' => 'Mara Lupano',
            'email' => 'mara@salviharps.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $this->post('/register', $user)
            ->assertStatus(302);

        $user = User::firstWhere('email', 'mara@salviharps.com');

        $this->assertDatabaseHas('mothers', [
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function a_user_can_login()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $mother = Mother::factory()->create([
            'user_id' => $user->id,
        ]);

        $data = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $this->post('/login', $data)
            ->assertStatus(302);

        $this->get('/api/user')
            ->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'email' => $user->email,
                'name' => $user->name,
                'mother' => [
                    'id' => 1,
                    'user_id' => 1,
                ],
            ]);
    }
}
