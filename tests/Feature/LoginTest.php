<?php

declare(strict_types=1);

namespace Feature;

class LoginTest extends BaseTest
{
    public function test_login_success()
    {
        $response = $this->postJson(route('login'), $this->getCredentials());

        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }

    public function test_login_failure_with_invalid_credentials()
    {
        $this->password = 'wrongpassword';
        $response = $this->postJson(route('login'), $this->getCredentials());

        $response->assertStatus(401)
            ->assertJson(['message' => 'Invalid credentials']);
    }
}
