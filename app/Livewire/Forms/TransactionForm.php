<?php

namespace App\Livewire\Forms;

use App\Models\Transaction;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TransactionForm extends Form
{
    public ?Transaction $transaction;
    public $invoice_number, $transaction_date, $total_price, $customer_name, $payment_method, $table_number, $payment_status;

    public function rules(): array
    {
        return [
            'invoice_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('transactions', 'invoice_number')->ignore($this->transaction?->id),
            ],
            'transaction_date' => 'required|date',
            'total_price' => 'required|numeric|min:0',
            'customer_name' => 'nullable|string|max:255',
            'payment_method' => 'required|string|in:cash,e-wallet,credit',
            'table_number' => 'nullable|string|max:50',
            'payment_status' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'invoice_number.required' => 'The invoice number field is required.',
            'invoice_number.string' => 'The invoice number must be a string.',
            'invoice_number.max' => 'The invoice number must not be greater than 255 characters.',
            'invoice_number.unique' => 'The invoice number has already been taken.',

            'transaction_date.required' => 'The transaction date field is required.',
            'transaction_date.date' => 'The transaction date is not a valid date format.',

            'total_price.required' => 'The total price field is required.',
            'total_price.numeric' => 'The total price must be a number.',
            'total_price.min' => 'The total price must be at least 0.',

            'customer_name.string' => 'The customer name must be a string.',
            'customer_name.max' => 'The customer name must not be greater than 255 characters.',

            'payment_method.required' => 'The payment method field is required.',
            'payment_method.string' => 'The payment method must be a string.',
            'payment_method.max' => 'The payment method must not be greater than 255 characters.',
            'payment_method.in' => 'The payment method must be one of the following: cash, e-wallet, credit.',

            'table_number.string' => 'The table number must be a string.',
            'table_number.max' => 'The table number must not be greater than 50 characters.',

            'payment_status.required' => 'The payment status field is required.',
            'payment_status.boolean' => 'The payment status must be a boolean (true or false).',
        ];
    }

    public function setData(?Transaction $transaction)
    {
        $this->transaction = $transaction;
        $this->invoice_number = $transaction->invoice_number;
        $this->transaction_date = $transaction->transaction_date;
        $this->total_price = $transaction->total_price;
        $this->customer_name = $transaction->customer_name;
        $this->payment_method = $transaction->payment_method;
        $this->table_number = $transaction->table_number;
        $this->payment_status = $transaction->payment_status;
    }

    public function update()
    {
        $this->transaction->update($this->validate());
    }
}
