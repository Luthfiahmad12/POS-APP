<div>
    <div>
        <div class="flex flex-col lg:flex-row justify-between lg:items-center">
            <flux:heading size="xl" level="1" class="mb-6">Transaction List</flux:heading>
            <flux:button href="{{ route('transactions.create') }}" variant="primary" wire:navigate>
                Create Transaction
            </flux:button>
        </div>
        <flux:separator variant="subtle" />
        <div id="table">
            <div
                class="overflow-hidden w-full overflow-x-auto rounded-radius border border-outline dark:border-outline-dark">
                <table class="w-full text-left text-sm text-on-surface dark:text-on-surface-dark">
                    <thead
                        class="border-b border-outline bg-surface-alt text-sm text-on-surface-strong dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong uppercase">
                        <tr>
                            <th scope="col" class="p-4">invoice</th>
                            <th scope="col" class="p-4">total</th>
                            <th scope="col" class="p-4">transaction date</th>
                            <th scope="col" class="p-4">action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline dark:divide-outline-dark">
                        @foreach ($transactions as $item)
                            <tr>
                                <td class="p-4">{{ $item->invoice_number }}</td>
                                <td class="p-4">{{ 'IDR. ' . number_format($item->total_price) }}</td>
                                <td class="p-4">{{ $item->transaction_date }}</td>
                                <td class="p-4 flex gap-2">
                                    <flux:button href="{{ route('transactions.detail', $item) }}" wire:navigate>
                                        Detail
                                    </flux:button>
                                    <flux:button variant="danger" wire:click="destroy('{{ $item->id }}')">
                                        Delete
                                    </flux:button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
