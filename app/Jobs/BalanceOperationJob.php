<?php

declare(strict_types=1);

namespace App\Jobs;

use App\DataTransferObjects\BalanceOperationDto;
use App\Services\OperationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;

class BalanceOperationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected readonly BalanceOperationDto $dto,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(OperationService $service): void
    {
        try {
            DB::transaction(fn() => $service->saveBalanceOperation($this->dto));
        } catch (Exception $exception) {
            $this->fail($exception);
            Log::error($exception->getMessage());
        }
    }
}
