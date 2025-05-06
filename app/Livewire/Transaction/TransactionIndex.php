<?php

namespace App\Livewire\Transaction;

use App\Services\TransactionService;
use App\Traits\DispatchNotificationTrait;
use Livewire\Component;

class TransactionIndex extends Component
{
    use DispatchNotificationTrait;

    private $transactionService;

    public function boot(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function destroy(string $id)
    {
        $this->transactionService->delete($id);
        $this->warningNotify('Notice!', 'Transaction Deleted');
    }
    public function render()
    {
        return view('livewire.transaction.transaction-index', [
            'transactions' => $this->transactionService->getAll(),
        ]);
    }
}
