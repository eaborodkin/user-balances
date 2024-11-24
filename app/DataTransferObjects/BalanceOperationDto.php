<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\Exceptions\Exception;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use MichaelRubel\ValueObjects\Collection\Complex\Email;
use App\ValueObjects\NumberWithNegativeValues as Number;
use Throwable;

class BalanceOperationDto extends BaseDto
{
    /**
     * @throws Exception
     */
    public function __construct(
        public readonly User   $user,
        public readonly Number $amount,
        public readonly string $description,
    ) {
        match (true) {
            $this->hasNullBalance() => throw Exception::userWithoutBalance(),
            $this->newValueLessThanZero() => throw Exception::userWillHaveNegativeBalance(),
            default => null,
        };
    }

    /**
     * @throws Exception
     * @throws Throwable
     */
    public static function makeFromCommandParams(
        Email  $email,
        Number $amount,
        bool   $spending,
        string $description,
    ): static {
        try {
            return new static(
                user: User::whereEmail($email->value)->firstOrFail(),
                amount: $spending ? Number::make($amount->multiply(-1)) : $amount,
                description: $description,
            );
        } catch (Throwable $e) {
            throw match (get_class($e)) {
                ModelNotFoundException::class => Exception::userWithEmailNotRegistered(),
                default => $e,
            };
        }
    }

    public function toArray(): array
    {
        return [
            'value' => $this->amount,
            'description' => $this->description,
        ];
    }

    protected function hasNullBalance(): bool
    {
        return !$this->user->balance;
    }

    protected function newValueLessThanZero(): bool
    {
        /** @var Number $balanceValue */
        $balanceValue = $this->user->balance->value;

        return $balanceValue->add($this->amount->value()) < 0;
    }
}
