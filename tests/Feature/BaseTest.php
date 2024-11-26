<?php

declare(strict_types=1);

namespace Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use MichaelRubel\ValueObjects\Collection\Complex\Email;
use Tests\TestCase;

class BaseTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected Email $email;
    protected string $password;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->email = Email::make($this->faker->email);
        $this->password = $this->faker->password;
        $this->user = $this->createUser();
    }

    protected function getCredentials(): array
    {
        return [
            'email' => $this->email->value(),
            'password' => $this->password,
        ];
    }

    protected function createUser(): User
    {
        return User::factory()->create($this->getCredentials());
    }
}
