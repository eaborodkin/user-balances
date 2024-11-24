<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\User;

use App\DataTransferObjects\HistoryDto;
use App\Http\Controllers\Controller;
use App\Http\Filters\OperationFilter;
use App\Http\Requests\User\HistoryRequest;
use App\Http\Resources\User\OperationResource;
use App\Services\OperationService;

class HistoryController extends Controller
{
    public function __construct(protected readonly OperationService $service)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(HistoryRequest $request)
    {
        $dto = HistoryDto::fromRequest($request);

        $operations = $this->service->getOperations($dto)->paginate(10);

        return OperationResource::collection($operations);
    }
}
