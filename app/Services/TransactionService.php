<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionService
{
    public function getAll()
    {
        return Transaction::latest()->get();
    }
    public function create($cartTotal)
    {
        $data = [
            'invoice_number' => 'INV-' . rand(00000, 99999),
            'total_price' => $cartTotal,
        ];
        return Transaction::create($data);
    }

    public function delete(string $id)
    {
        return Transaction::findOrFail($id)->delete();
    }

    public function findById($id)
    {
        return Transaction::findOrFail($id);
    }
}
