<div>
    <div class="flex flex-col lg:flex-row justify-between lg:items-center">
        <flux:heading size="xl" level="1">Create Transaction</flux:heading>
        <div class="flex gap-2">
            <flux:button href="{{ route('transactions.index') }}" variant="danger" wire:navigate>
                Back
            </flux:button>
            <flux:modal.trigger name="view-cart">
                <flux:tooltip content="View Cart">
                    <flux:button icon="shopping-cart" class="cursor-pointer" x-on:click="$flux.modal('view-cart').show()">
                        <flux:badge color="green">{{ $cartCount }}</flux:badge>
                    </flux:button>
                </flux:tooltip>
            </flux:modal.trigger>
        </div>
    </div>
    <flux:separator variant="subtle" class="my-6" />

    <div id="main">
        <flux:heading size="lg" class="mb-3">Available Products</flux:heading>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            @foreach ($products as $item)
                <article
                    class="group flex flex-col rounded-radius overflow-hidden border border-outline bg-surface-alt text-on-surface dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark">

                    <div class="flex flex-col justify-between h-full p-3 gap-4">
                        <div class="flex-1 flex flex-col gap-4">
                            <div class="flex flex-col md:flex-row justify-between gap-4 md:gap-12">
                                <flux:tooltip content="Stock : {{ $item->stock }}">
                                    <h3 class="text-md font-bold text-on-surface-strong dark:text-on-surface-dark-strong"
                                        aria-describedby="productDescription">
                                        {{ $item->name }}
                                    </h3>
                                </flux:tooltip>
                                <span class="text-md font-semibold">
                                    {{ 'IDR. ' . number_format($item->price) }}
                                </span>
                            </div>

                            <p id="productDescription" class="text-sm text-pretty">
                                {{ Str::limit($item->description, 50) }}
                            </p>
                        </div>

                        <flux:button class="cursor-pointer" icon="shopping-cart" size="sm"
                            wire:click="addToCart('{{ $item->id }}')" wire:loading.attr="disabled">
                            Add To Cart
                        </flux:button>
                    </div>

                </article>
            @endforeach
        </div>
    </div>

    <livewire:transaction.cart />
</div>
