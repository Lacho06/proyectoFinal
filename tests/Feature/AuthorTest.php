<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public $user;
    public $author;

    public function loginVice(){
        $this->user = User::create([
            'name' => 'Vice',
            'lastname' => 'Vice',
            'email' => 'Vice@gmail.com',
            'phone' => 52346782,
            'solapin' => 'E123416',
            'password' => bcrypt('12345678'),
            'role' => 'vicerector'
        ]);

        $this->assertCredentials([
            'email' => $this->user->email,
            'password' => 12345678
        ]);
        Auth::login($this->user);
        $this->assertAuthenticatedAs($this->user);
    }

    public function getAuthor(){
        $this->author = Author::create([
            'name' => 'Ejemplo',
            'lastname' => 'Ejemplo',
            'email' => 'Ejemplo@gmail.com',
            'phone' => 52346789,
        ]);
    }

    /** @test */
    public function it_can_see_index_view()
    {
        $response = $this->loginVice();
        $uri = route('author.index');
        $response = $this->get($uri);
        $response->assertOk();
        $response->assertViewIs('author.index');
    }

    /** @test */
    public function it_can_create_author()
    {
        $this->assertCount(0, Author::all());

        $this->getAuthor();

        $uri = route('author.store');
        $this->post($uri, ['author' => $this->author]);

        $this->assertCount(1, Author::all());
        $data = Author::first();

        $this->assertEquals($this->author->name, $data->name);
        $this->assertEquals($this->author->lastname, $data->lastname);
        $this->assertEquals($this->author->email, $data->email);
        $this->assertEquals($this->author->phone, $data->phone);
    }

    /** @test */
    public function it_can_see_show_view(){

        $response = $this->loginVice();
        $this->getAuthor();
        $uri = route('author.show', ['author', $this->author]);
        $response = $this->get($uri, $this->author);
        $response->assertOk();
        $response->assertViewIs('author.show', compact('user'));
    }

    /** @test */
    public function it_can_see_edit_view(){
        $response = $this->loginVice();
        $uri = route('author.edit', $this->user);
        $response = $this->get($uri);
        $response->assertOk();
        $response->assertViewIs('author.edit', compact('user'));
    }

    /** @test */
    public function it_can_delete_author(){
        $author = Author::create([
            'name' => 'Ejemplo2',
            'lastname' => 'Ejemplo2',
            'email' => 'Ejemplo2@gmail.com',
            'phone' => 52346784,
            'solapin' => 'E123456',
            'password' => Hash::make('12345678'),
            'role' => 'asistente'
        ]);

        $this->assertCount(1, Author::all());
        $author->delete();
        $this->assertCount(0, Author::all());
    }
}
