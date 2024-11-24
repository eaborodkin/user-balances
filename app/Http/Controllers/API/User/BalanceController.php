<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\User;

use App\DataTransferObjects\BalanceDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\BalanceRequest;
use App\Http\Resources\User\BalanceResource;

class BalanceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(BalanceRequest $request)
    {
        return BalanceResource::make(BalanceDto::fromRequest($request));
    }
}
