<div>
    <div class="flex flex-col lg:flex-row justify-between lg:items-center">
        <flux:heading size="xl" level="1" class="mb-6">Transaction Detail</flux:heading>
        <flux:button href="{{ route('transactions.index') }}" variant="danger" wire:navigate>
            Back
        </flux:button>
    </div>
    <flux:separator variant="subtle" />

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="col-span-3">
            <flux:heading size="lg" class="my-3">Transaction Item</flux:heading>
            <div
                class="overflow-hidden w-full overflow-x-auto rounded-radius border border-outline dark:border-outline-dark">
                <table class="w-full text-left text-sm text-on-surface dark:text-on-surface-dark">
                    <thead
                        class="border-b border-outline bg-surface-alt text-sm text-on-surface-strong dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong">
                        <tr>
                            <th scope="col" class="p-4">SKU</th>
                            <th scope="col" class="p-4">Product Name</th>
                            <th scope="col" class="p-4">Quantity</th>
                            <th scope="col" class="p-4">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline dark:divide-outline-dark">
                        @foreach ($transaction->items as $item)
                            <tr class="even:bg-primary/5 dark:even:bg-primary-dark/10">
                                <td class="p-4">{{ $item->product->sku }}</td>
                                <td class="p-4">{{ $item->product->name }}</td>
                                <td class="p-4">{{ $item->quantity }}</td>
                                <td class="p-4">{{ 'IDR. ' . number_format($item->subtotal) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="p-4 font-bold text-lg text-center">Total</td>
                            <td class="p-4 font-bold text-md">
                                {{ 'IDR. ' . number_format($transaction->total_price) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-span-2">
            @if ($transaction->payment_status)
                <flux:heading size="lg" class="my-3">Details</flux:heading>
                <div
                    class="group flex rounded-radius w-full flex-col overflow-hidden border-2 border-primary bg-surface-alt p-6 text-on-surface dark:border-primary-dark dark:bg-surface-dark-alt dark:text-on-surface-dark">
                    <span class="ml-auto">
                        <flux:badge color="green" size="md">
                            CUSTOMER ALREADY PAID
                        </flux:badge>
                    </span>
                    <flux:heading size="lg" class="mb-2">
                        Payment Detail
                    </flux:heading>

                    <div class="space-y-2">
                        <flux:text>
                            Customer Name : {{ $transaction->customer_name }}
                        </flux:text>
                        <flux:text>
                            Table Number : {{ $transaction->table_number }}
                        </flux:text>
                        <flux:text>
                            Payment Method : {{ $transaction->payment_method }}
                        </flux:text>
                    </div>

                    <flux:button type="button" variant="primary" class="mt-4" x-on:click="alert('soon')">
                        Download Invoice
                    </flux:button>
                </div>
            @else
                <flux:heading size="lg" class="my-3">Billing Details</flux:heading>
                <dix
                    class="group flex rounded-radius max-w-sm flex-col overflow-hidden border border-outline bg-surface-alt text-on-surface dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark">
                    <form wire:submit="save">
                        <div class="flex flex-col gap-4 p-6">
                            <flux:input wire:model="form.customer_name" label="Customer Name" placeholder="anonim" />
                            <flux:input wire:model="form.table_number" label="Table Number" />
                            <flux:select wire:model="form.payment_method" label="Payment Method"
                                placeholder="Choose payment...">
                                <flux:select.option value="cash">Cash</flux:select.option>
                                <flux:select.option value="e-wallet">E-Wallet</flux:select.option>
                                <flux:select.option value="credit">Credit Card</flux:select.option>
                            </flux:select>
                            <flux:fieldset>
                                <flux:legend>Payment Status</flux:legend>
                                <div x-data="{ isPaid: @entangle('form.payment_status') }">
                                    <label for="defaultToggle" class="inline-flex items-center gap-3">
                                        <input id="defaultToggle" type="checkbox" @click="isPaid = !isPaid"
                                            class="peer sr-only" role="switch" x-model="isPaid" />
                                        <div class="relative h-7 w-12 after:h-6 after:w-6 peer-checked:after:translate-x-5 rounded-full border border-outline bg-surface-alt after:absolute after:bottom-0 after:left-[0.0625rem] after:top-0 after:my-auto after:rounded-full after:bg-on-surface after:transition-all after:content-[''] peer-checked:bg-primary peer-checked:after:bg-on-primary peer-focus:outline-2 peer-focus:outline-offset-2 peer-focus:outline-outline-strong peer-focus:peer-checked:outline-primary peer-active:outline-offset-0 peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:border-outline-dark dark:bg-surface-dark-alt dark:after:bg-on-surface-dark dark:peer-checked:bg-primary-dark dark:peer-checked:after:bg-on-primary-dark dark:peer-focus:outline-outline-dark-strong dark:peer-focus:peer-checked:outline-primary-dark"
                                            aria-hidden="true">
                                        </div>
                                        <span x-text="isPaid ? 'Paid' : 'Pending'"
                                            class="trancking-wide text-base font-medium text-on-surface peer-checked:text-on-surface-strong peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:text-on-surface-dark dark:peer-checked:text-on-surface-dark-strong">
                                        </span>
                                    </label>
                                </div>
                            </flux:fieldset>
                            <flux:button class="w-full uppercase" type="submit">
                                save change
                            </flux:button>
                        </div>
                    </form>
                </dix>
            @endif
        </div>
    </div>
</div>
