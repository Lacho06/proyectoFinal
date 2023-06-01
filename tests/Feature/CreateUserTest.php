<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function createUser($data = []){
        $uri = route('user.store');
        return $this->post($uri, $data);
    }
    /*
    *   @test
    */
    public function it_can_create_user()
    {
        $user = User::factory()->make();
        $response = $this->createUser([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'role' => $user->role,
        ]);

        $this->assertCount(1, User::all());
        $data = User::first();

        $this->assertEquals($data->name, $user->name);
        $this->assertEquals($data->email, $user->email);
        $this->assertTrue(Hash::check($data->password, $user->password));
        $this->assertEquals($data->role, $user->role);

        // $response->assertRedirect(route('user.show'));
        // $response->assertSessionHas('flash_message', 'Usuario Creado');
    }
}
