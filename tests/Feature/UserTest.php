<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public $admin;

    public function loginAdmin(){
        $admin = User::factory()->create([
            'role' => 'administrador'
        ]);
        Auth::login($admin);
        return $this->admin = $admin;
    }

    /** @test */
    public function it_can_create_user()
    {
        $this->assertCount(0, User::all());

        $user = User::create([
            'name' => 'Ejemplo',
            'lastname' => 'Ejemplo',
            'email' => 'Ejemplo@gmail.com',
            'phone' => 52346789,
            'solapin' => 'E123456',
            'password' => Hash::make('12345678'),
            'role' => 'administrador'
        ]);

        $uri = route('user.store');
        $response = $this->post($uri, $user);

        $this->assertCount(1, User::all());
        $data = User::first();

        $this->assertEquals($user->name, $data->name);
        $this->assertEquals($user->lastname, $data->lastname);
        $this->assertEquals($user->email, $data->email);
        $this->assertEquals($user->phone, $data->phone);
        $this->assertEquals($user->solapin, $data->solapin);
        $this->assertTrue(Hash::check('12345678', $data->password));
        $this->assertEquals($user->role, $data->role);

        $response->assertRedirect(route('user.show', $user));
        $response->assertSessionHas('message', 'Usuario creado');
    }

    /** @test */
    public function it_can_see_create_view(){
        $this->loginAdmin();
        $uri = route('user.create');
        $response = $this->actingAs($this->admin)->get($uri);
        $response->assertOK();
        $response->assertViewIs('user.create');
    }
}
