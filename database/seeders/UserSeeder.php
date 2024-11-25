<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Balance;
use App\Models\Operation;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(3)
            ->state(function () {
                $email = fake()->email;
                return [
                    'name' => fake()->name,
                    'email' => $email,
                    'password' => Hash::make($email),
                ];
            })
            ->has(
                Balance::factory()
                    ->has(
                        Operation::factory() // Первая операция
                    )
                    ->has(
                        Operation::factory(20)->spending() // Дополнительные операции
                    )
            )
            ->create();
    }
}
