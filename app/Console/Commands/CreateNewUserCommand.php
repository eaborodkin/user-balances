<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateNewUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создание нового пользователя';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $user = [
            'name' => $this->ask('Введите имя пользователя'),
            'email' => $this->ask('Введите адрес электронной почты пользователя'),
            'password' => Hash::make($this->secret('Введите пароль пользователя')),
        ];
        User::create($user);

        $this->info("Пользователь {$user['name']} с Email {$user['email']} был успешно создан!");

        return self::SUCCESS;
    }
}
