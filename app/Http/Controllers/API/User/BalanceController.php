<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\BalanceResource;
use App\Models\User;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return BalanceResource::make($request->user());
    }
}
