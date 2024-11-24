<?php

declare(strict_types=1);

namespace App\Exceptions;

use \Exception as BaseException;
use \Symfony\Component\HttpFoundation\Response;

class Exception extends BaseException
{
    public static function userWithEmailNotRegistered(): self
    {
        return new static('User with such an email not registered', Response::HTTP_CONFLICT);
    }
    public static function userWithoutBalance(): self
    {
        return new static('Needs non-null Balance!', Response::HTTP_PAYMENT_REQUIRED);
    }

    public static function userWillHaveNegativeBalance(): self
    {
        return new static(
            'Operation is not allowed due to the resulting balance cannot be negative.',
            Response::HTTP_METHOD_NOT_ALLOWED,
        );
    }
}
