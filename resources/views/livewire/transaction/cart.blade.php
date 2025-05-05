<flux:modal name="view-cart" variant="flyout" class="w-xl">
    <div class="space-y-6">
        <div>
            <flux:heading size="xl" class="font-bold">Shopping Cart</flux:heading>
        </div>
        @foreach ($cart as $item)
            <div
                class="flex gap-4 border border-outline bg-surface-alt p-3 text-on-surface dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark px-4 py-6 rounded-md shadow border">
                <div class="flex gap-6 sm:gap-4 max-sm:flex-col">
                    <div class="flex flex-col gap-4">
                        <div>
                            <h3
                                class="text-sm sm:text-base font-semibold text-on-surface-strong dark:text-on-surface-dark-strong">
                                {{ $item['name'] }}
                            </h3>
                            <p class="text-[13px] font-medium text-pretty mt-2 flex items-center gap-2">
                                {{ 'IDR. ' . number_format($item['price']) }}
                            </p>
                        </div>
                        <div class="mt-auto">
                            <h3 class="text-md font-semibold text-on-surface-strong dark:text-on-surface-dark-strong">
                                {{ 'IDR. ' . number_format($item['subtotal']) }}
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="ml-auto flex flex-col">
                    <div class="flex items-start gap-4 justify-end">
                        {{-- delete --}}
                        <button wire:click="deleteItem('{{ $item['id'] }}')">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 cursor-pointer fill-slate-400 hover:fill-red-600 inline-block"
                                viewBox="0 0 24 24">
                                <path
                                    d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z"
                                    data-original="#000000"></path>
                                <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z"
                                    data-original="#000000"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-center gap-3 mt-auto">
                        <flux:button icon="minus" wire:click="decrementQty('{{ $item['id'] }}')"
                            class="flex items-center justify-center w-[20px] h-[20px] bg-slate-400 outline-none rounded-full cursor-pointer">
                        </flux:button>
                        <span class="font-semibold text-base leading-[20px]">{{ $item['qty'] }}</span>
                        <flux:button icon="plus" wire:click="incrementQty('{{ $item['id'] }}')"
                            class="flex items-center justify-center w-[20px] h-[20px] bg-slate-800 outline-none rounded-full cursor-pointer">
                        </flux:button>
                    </div>
                </div>
            </div>
        @endforeach
        @if (count($cart) !== 0)
            <flux:separator />
            <flux:heading size="xl" class="flex flex-wrap">Total
                <span class="ml-auto">{{ 'IDR. ' . number_format($cartTotal) }}</span>
            </flux:heading>
            <flux:separator />
            <div class="flex gap-2">
                <flux:spacer />
                <flux:button wire:click="bulkDelete" type="button" variant="danger">Delete All Item</flux:button>
                <flux:button variant="primary" wire:click="createTransaction">Create Transaction</flux:button>
            </div>
        @endif
    </div>
</flux:modal>
