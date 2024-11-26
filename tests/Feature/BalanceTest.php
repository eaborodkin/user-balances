<?php

declare(strict_types=1);

namespace Feature;

use App\Models\Balance;
use App\ValueObjects\NumberWithNegativeValues as Number;
use Laravel\Sanctum\Sanctum;

class BalanceTest extends BaseTest
{
    public function test_get_user_balance()
    {
        $amount = 1000;
        $user = $this->createUser();
        Balance::factory()->create(['user_id' => $user->id, 'amount' => Number::make($amount)]);

        Sanctum::actingAs($user);

        $response = $this->getJson(route('user.balance'));

        $response->assertStatus(200)
            ->assertJson(['amount' => $amount]);
    }

    public function test_get_user_balance_unauthenticated()
    {
        $response = $this->getJson(route('user.balance'));

        $response->assertStatus(401);
    }
}
