<?php

namespace App\Jobs;

use App\Services\BalanceOperationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Exception;

class BalanceOperationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected BalanceOperationService $service
    )
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            DB::beginTransaction();

            $this->service->getBalance()->value = $this->service->getBalanceNewValue();
            // Внесение изменения в баланс пользователя в БД
            $this->service->getBalance()->save();

            // Внесение информации об операции в БД
            $this->service->getBalance()->operations()->create([
                'value' => $this->service->operation->getValue(),
                'description' => $this->service->operation->descriptionRawValue,
            ]);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            $this->fail($exception);
        }
    }
}
