<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Component;

class TransactionIndex extends Component
{
    public function destroy(string $id)
    {
        Transaction::find($id)->delete();
    }
    public function render()
    {
        return view('livewire.transaction.transaction-index', [
            'transactions' => Transaction::latest()->get()
        ]);
    }
}
