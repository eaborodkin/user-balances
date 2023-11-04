<?php

namespace App\Console\Commands;

use App\Jobs\BalanceOperationJob;
use App\Services\BalanceOperationService;
use App\ValueObjects\BalanceOperation;
use Illuminate\Console\Command;
use Exception;

class BalanceOperationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:balance-operation
        {email : E-mail пользователя}
        {value : Значение на которое изменится баланс пользователя}
        {--spending : Указывается, если расходование}
        {description : Комментарий}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Начисление/списание по E-mail пользователя с указанием описания операции';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        try {
            $service = new BalanceOperationService(
                new BalanceOperation(
                    emailRawValue: $this->argument('email'),
                    valueRawValue: (int)$this->argument('value'),
                    spendingRawValue: $this->option('spending'),
                    descriptionRawValue: $this->argument('description'),
                )
            );
            $service->checkExceptions();

            BalanceOperationJob::dispatch($service);
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
            return self::FAILURE;
        }


        $message = "Операция ";
        $message .= ($service->operation->spendingRawValue) ? 'списания с' : 'пополнения';
        $message .= " баланса пользователя с E-mail {$service->operation->emailRawValue} на сумму ";
        $message .= $service->operation->valueRawValue;
        $message .= " будет выполнена в очереди.";

        $this->info($message);

        return self::SUCCESS;
    }
}
