<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\HistoryRequest;
use App\Http\Resources\User\OperationResource;
use App\Models\Operation;

class HistoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(HistoryRequest $request)
    {
        $validated = $request->validated();

        $balanceId = $request->user()->balance->id;

        $query = Operation::where('balance_id', $balanceId);

        if (null !== $validated['search']) {
            $validated['search'] = trim(strtolower($validated['search']));
            $query = $query->whereRaw('LOWER(`description`) LIKE ? ', ["%{$validated['search']}%"]);
        }

        $query = $query->orderBy('updated_at', $validated['order']);

        $operations = $query->paginate(10);

        return OperationResource::collection($operations);
    }
}
