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
        $this->admin = User::create([
            'name' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'Admin@gmail.com',
            'phone' => 52346784,
            'solapin' => 'E123456',
            'password' => bcrypt('12345678'),
            'role' => 'administrador'
        ]);

        $this->assertCredentials([
            'email' => $this->admin->email,
            'password' => 12345678
        ]);
        Auth::login($this->admin);
        $this->assertAuthenticatedAs($this->admin);
    }

    /** @test */
    public function it_can_see_index_view(){
        $response = $this->loginAdmin();
        $uri = route('user.index');
        $response = $this->get($uri);
        $response->assertOk();
        $response->assertViewIs('user.index');
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
        $this->post($uri, ['user' => $user]);

        $this->assertCount(1, User::all());
        $data = User::first();

        $this->assertEquals($user->name, $data->name);
        $this->assertEquals($user->lastname, $data->lastname);
        $this->assertEquals($user->email, $data->email);
        $this->assertEquals($user->phone, $data->phone);
        $this->assertEquals($user->solapin, $data->solapin);
        $this->assertTrue(Hash::check('12345678', $data->password));
        $this->assertEquals($user->role, $data->role);
    }

    /** @test */
    public function it_can_see_show_view(){
        $response = $this->loginAdmin();
        $uri = route('user.show', ['user', $this->admin]);
        $response = $this->get($uri, $this->admin);
        $response->assertOk();
        $response->assertViewIs('user.show', compact('admin'));
    }

    /** @test */
    public function it_can_see_edit_view(){
        $response = $this->loginAdmin();
        $uri = route('user.edit', $this->admin);
        $response = $this->get($uri);
        $response->assertOk();
        $response->assertViewIs('user.edit', compact('admin'));
    }

    /** @test */
    public function it_can_delete_user(){
        $user = User::create([
            'name' => 'Ejemplo2',
            'lastname' => 'Ejemplo2',
            'email' => 'Ejemplo2@gmail.com',
            'phone' => 52346784,
            'solapin' => 'E123456',
            'password' => Hash::make('12345678'),
            'role' => 'asistente'
        ]);
        $this->assertCount(1, User::all());
        $user->delete();
        $this->assertCount(0, User::all());
    }
}
