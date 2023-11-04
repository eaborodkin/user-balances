<?php

namespace App\Services;

use App\Models\Balance;
use App\Models\User;
use App\ValueObjects\BalanceOperation;
use Illuminate\Database\Eloquent\Builder;
use Exception;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BalanceOperationService
{
    protected ?User $user;

    /**
     * @throws Exception
     */
    public function __construct(readonly BalanceOperation $operation)
    {
        /** @var Builder $user */
        $user = new User();
        $this->user = $user->where('email', $this->operation->emailRawValue)->first();
    }

    /**
     * @throws Exception
     */
    public function getUser(): User|HasOne
    {
        // Если пользователя с таким E-mail в системе не найдено
        if (!$this->user) {
            throw new Exception("Пользователя с E-mail {$this->operation->emailRawValue} не найдено. ");
        }

        return $this->user;
    }

    /**
     * @throws Exception
     */
    public function getBalance(): Balance|HasOne
    {
        if (!$this->user->balance) {
            throw new Exception('Needed non-null Balance to make operation with this!');
        }

        return $this->user->balance;
    }

    /**
     * @throws Exception
     */
    public function getBalanceNewValue():int
    {
        $newValue = $this->user->balance->value + $this->operation->getValue();
        // Если операция приводит к отрицательному балансу
        if ($newValue < 0) {
            throw new Exception('Недопустимая операция, т.к. результирующий баланс меньше нуля.');
        }
        return $newValue;
    }


    /**
     * @throws Exception
     */
    public function checkExceptions():void
    {
        $this->getUser();
        $this->getBalanceNewValue();
    }
}
