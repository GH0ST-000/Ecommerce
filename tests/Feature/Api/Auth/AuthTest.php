<?php

namespace Feature\Api\Auth;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginWithValidCredentials(): void
    {
        $this->createTestUser('test@test.com', 'password');

        $response = $this->postJson('/api/login', [
            'email' => 'test@test.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }

    public function testLoginWithInvalidCredentials(): void
    {
        $this->createTestUser('test@test.com', 'password');

        $response = $this->postJson('/api/login', [
            'email' => 'wrong@test.com',
            'password' => 'wrongPassword',
        ]);

        $response->assertStatus(401)
            ->assertJson(['error' => 'Unauthorized']);
    }

    public function testLoginValidation(): void
    {
        $response = $this->postJson('/api/login', [
            'email' => '',
            'password' => '',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password']);
    }

    public function testRegisterValidation(): void
    {
        $response = $this->postJson('/api/register', [
            'email' => '',
            'name' => '',
            'lastname' => '',
            'password' => '',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'name', 'lastname', 'password']);
    }

    public function testRegisterWithValidCredentials(): void
    {
        $userData = [
            'name' => 'test',
            'lastname' => 'test2',
            'role' => 'moderator',
            'email' => 'test1@gmail.com',
            'password' => '1qaz!QAZ',
            'password_confirmation' => '1qaz!QAZ',
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(201)
            ->assertJson(['message' => 'User registered successfully']);
    }

    private function createTestUser(string $email, string $password): void
    {
        User::factory()->create([
            'email' => $email,
            'name' => 'test',
            'lastname' => 'test',
            'role' => 'moderator',
            'password' => bcrypt($password),
        ]);
    }
}
