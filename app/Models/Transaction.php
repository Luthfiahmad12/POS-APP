<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Transaction extends Model
{
    use HasUuids;

    protected $fillable = [
        'invoice_number',
        'transaction_date',
        'total_price',
        'customer_name',
        'payment_method',
        'table_number',
        'payment_status'
    ];

    public function casts()
    {
        return [
            'transaction_date' => 'datetime'
        ];
    }

    public function items(): HasMany
    {
        return $this->HasMany(TransactionItem::class);
    }


    public function TransactionDate(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('d F Y H:i'),
        );
    }
}
