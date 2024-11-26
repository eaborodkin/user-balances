<?php

declare(strict_types=1);

namespace Feature;

use App\Models\Operation;
use App\ValueObjects\NumberWithNegativeValues as Number;
use Laravel\Sanctum\Sanctum;

class HistoryTest extends BaseTest
{
    public function test_get_user_balance_history()
    {
        $amount = 1000;
        $user = $this->createUser();
        Operation::factory(10)->create(['user_id' => $user->id, 'amount' => Number::make($amount)]);

        Sanctum::actingAs($user);
        $response = $this->getJson(route('user.balance.history'));

        $response->assertStatus(200)
            ->assertJsonCount(10);
    }

    public function test_get_user_balance_history_unauthenticated()
    {
        $response = $this->getJson(route('user.balance.history'));

        $response->assertStatus(401);
    }
}
