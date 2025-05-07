<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;
use App\Models\{Product, Transaction};

new #[Title('Dashboard')] class extends Component {
    public $productCount;
    public $transactionCount;
    public $transactionSuccess;

    public function mount()
    {
        $this->productCount = Product::count();
        $this->transactionCount = Transaction::count();
        $this->transactionSuccess = Transaction::where('payment_status', true)->count();
    }
}; ?>

<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        <div
            class="flex items-center relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 transform transition duration-500 hover:scale-105">
            <div class="p-4 w-full text-center">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                <flux:icon.cube class="text-amber-500 dark:text-amber-300 w-12 h-12 mb-3 inline-block" />
                <h2 class="title-font font-medium text-3xl text-gray-200">
                    {{ $productCount }}
                </h2>
                <flux:text size="lg">Product Available</flux:text>
            </div>
        </div>
        <div
            class="flex items-center relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 transform transition duration-500 hover:scale-105">
            <div class="p-4 w-full text-center">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                <flux:icon.credit-card class="text-amber-500 dark:text-amber-300 w-12 h-12 mb-3 inline-block" />
                <h2 class="title-font font-medium text-3xl text-gray-200">
                    {{ $transactionCount }}
                </h2>
                <flux:text size="lg">Transaction Total</flux:text>
            </div>
        </div>
        <div
            class="flex items-center relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 transform transition duration-500 hover:scale-105">
            <div class="p-4 w-full text-center">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                <flux:icon.credit-card class="text-amber-500 dark:text-amber-300 w-12 h-12 mb-3 inline-block" />
                <h2 class="title-font font-medium text-3xl text-gray-200">
                    {{ $transactionSuccess }}
                </h2>
                <flux:text size="lg">Transaction Success</flux:text>
            </div>
        </div>
    </div>
    <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
    </div>
</div>
