<?php

namespace Tests\Feature;

use App\Http\Resources\UserResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_set_database_config () {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_register () : void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Mandy',
            'email' => 'Mandy@gmail.com',
            'password' => '12345678',
            'confirm_password' => '12345678'
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'success' => true,
            'message' => 'User Created',
            'data' => [
                'email' => 'Mandy@gmail.com',
                'name' => 'Mandy',
            ]
        ]);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [
                'name',
                'email'
            ],
            'access_token'
        ]);

    }

    public function test_user_login () : void
    {
        $response = $this->postJson('/api/login', [
            'email' => 'Mandy@gmail.com',
            'password' => '12345678',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'User logged in',
            'data' => [
                'name' => 'Mandy',
                'email' => 'Mandy@gmail.com',
            ]
        ]);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [
                'name',
                'email'
            ],
            'access_token'
        ]);
        
    }
}
