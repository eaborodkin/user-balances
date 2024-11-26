<?php

declare(strict_types=1);

namespace Feature;

use Laravel\Sanctum\Sanctum;

class LogoutTest extends BaseTest
{
    public function test_logout_success()
    {
        $user = $this->createUser();
        Sanctum::actingAs($user);

        $response = $this->postJson(route('logout'));

        $response->assertStatus(204);
    }

    public function test_logout_unauthenticated()
    {
        $response = $this->postJson(route('logout'));

        $response->assertStatus(401);
    }
}
