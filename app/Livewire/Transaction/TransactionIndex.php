<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use App\Traits\DispatchNotificationTrait;
use Livewire\Component;

class TransactionIndex extends Component
{
    use DispatchNotificationTrait;

    public function destroy(string $id)
    {
        Transaction::find($id)->delete();
        $this->warningNotify('Notice!', 'Transaction Deleted');
    }
    public function render()
    {
        return view('livewire.transaction.transaction-index', [
            'transactions' => Transaction::latest()->get()
        ]);
    }
}
