<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\DataTransferObjects\BalanceOperationDto;
use App\Jobs\BalanceOperationJob;
use Illuminate\Console\Command;
use MichaelRubel\ValueObjects\Collection\Complex\Email;
use App\ValueObjects\NumberWithNegativeValues as Number;
use Throwable;

class BalanceOperationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:balance-operation
        {email : User\'s email}
        {amount : The value to which the user\'s balance will change}
        {--spending : Specify if spending operation}
        {description : Operation description}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Charging/debiting of funds via user\'s email with the description of the transaction';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        try {
            $dto = BalanceOperationDto::makeFromCommandParams(
                email: Email::from($this->argument('email')),
                amount: Number::from($this->argument('amount')),
                spending: (bool) $this->option('spending'),
                description: (string) $this->argument('description')
            );
            BalanceOperationJob::dispatchSync($dto);
        } catch (Throwable $exception) {
            $this->error($exception->getMessage());
            return self::FAILURE;
        }

        $this->info($this->getSuccessMessage($dto));

        return self::SUCCESS;
    }

    private function getSuccessMessage(BalanceOperationDto $dto): string
    {
        $message = "The transaction of ";
        $message .= $this->isDebitingOfFunds($dto) ? 'debiting of funds' : 'charging of funds';
        $message .= " from the balance of the user with Email {$dto->user->email} in the amount of ";
        $message .= $dto->amount->abs();
        $message .= " will be performed in a queue.";

        return $message;
    }

    private function isDebitingOfFunds(BalanceOperationDto $dto): bool
    {
        return bccomp($dto->amount->toString(), '0') < 0;
    }
}
