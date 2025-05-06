<?php

namespace App\Livewire\Transaction;

use App\Livewire\Forms\TransactionForm;
use App\Models\Transaction;
use Livewire\Component;

class TransactionDetail extends Component
{
    public $transaction;

    public TransactionForm $form;

    public function mount(?Transaction $transaction)
    {
        $this->transaction = $transaction;
        $this->form->setData($transaction);
    }

    public function save()
    {
        $this->form->update();
        return $this->redirect(route('transactions.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.transaction.transaction-detail');
    }
}
