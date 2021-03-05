<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_mother_can_login_from_app_with_token()
    {
        $this->withoutExceptionHandling();

        $mother = User::factory()->create([
            'email' => 'giovanna@prova.it',
            'password' => bcrypt('password'),
        ]);

        $response = $this->get('/sanctum/token?email=giovanna@prova.it&password=password&device_name=IPhoneXS')
            ->assertStatus(200);

        $token = $response->content();

    }
}
