<?php

use App\Livewire\Product\ProductCreate;
use App\Livewire\Product\ProductEdit;
use App\Livewire\Product\ProductIndex;
use App\Livewire\Transaction;
use App\Livewire\Transaction\TransactionCreate;
use App\Livewire\Transaction\TransactionDetail;
use App\Livewire\Transaction\TransactionIndex;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware(['auth'])->group(function () {
    Volt::route('dashboard', 'dashboard')->name('dashboard');

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('products', ProductIndex::class)->name('products.index');
    Route::get('products/create', ProductCreate::class)->name('products.create');
    Route::get('products/{product}/edit', ProductEdit::class)->name('products.edit');

    Route::get('transactions', TransactionIndex::class)->name('transactions.index');
    Route::get('transactions/create', TransactionCreate::class)->name('transactions.create');
    Route::get('transactions/{transaction}/detail', TransactionDetail::class)->name('transactions.detail');
});

require __DIR__ . '/auth.php';
