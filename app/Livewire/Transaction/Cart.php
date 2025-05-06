<?php

namespace App\Livewire\Transaction;

use App\Models\Product;
use App\Models\Transaction;
use App\Services\TransactionService;
use App\Traits\DispatchNotificationTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    use DispatchNotificationTrait;

    public $cart = [];
    public $cartTotal = 0;


    public function mount()
    {
        $this->cart = session()->get('cart', []);
        $this->cartTotal = $this->calculateCartTotal();
    }

    protected function calculateCartTotal()
    {
        return collect($this->cart)->sum(fn($item) => $item['subtotal']);
    }

    #[On('cart-added')]
    public function refreshCart($cart)
    {
        $this->cart = $cart;
        $this->cartTotal = $this->calculateCartTotal();
    }

    public function deleteItem(string $id)
    {
        $data = collect($this->cart)->search(fn($item) => $item['id'] == $id);
        if ($data !== false) {
            $updatedCart = collect($this->cart)
                ->reject(fn($item) => $item['id'] == $id)
                ->values()
                ->all();

            // Simpan ke session dan update local state
            session()->put('cart', $updatedCart);
            $this->cart = $updatedCart;

            $this->cartTotal = $this->calculateCartTotal();
            $this->dispatch('item-removed');
            $this->warningNotify('Warning', 'Product Removed');
        }
    }

    public function incrementQty(string $id)
    {
        foreach ($this->cart as $index => $item) {
            if ($item['id'] == $id) {
                $this->cart[$index]['qty']++;
                $this->cart[$index]['subtotal'] = $this->cart[$index]['qty'] * $this->cart[$index]['price'];
                break;
            }
        }

        // update session
        session()->put('cart', $this->cart);

        $this->cartTotal =  $this->calculateCartTotal();

        $this->infoNotify('Info', 'Product Incremented');
    }

    public function decrementQty(string $id)
    {
        foreach ($this->cart as $index => $item) {
            if ($item['id'] == $id) {
                $this->cart[$index]['qty']--;
                $this->cart[$index]['subtotal'] = $this->cart[$index]['qty'] * $this->cart[$index]['price'];
                break;
            }
        }

        // update session
        session()->put('cart', $this->cart);

        $this->cartTotal =  $this->calculateCartTotal();

        $this->infoNotify('Info', 'Product Decremented');
    }

    public function bulkDelete()
    {
        session()->forget('cart');
        $this->cart = [];
        $this->cartTotal = 0;
        $this->dispatch('cart-cleared');

        $this->infoNotify('Info', 'Cart Item Deleted');
    }

    public function createTransaction(TransactionService $transactionService)
    {
        $transaction = $transactionService->create($this->cartTotal);

        foreach ($this->cart as $item) {
            $transaction->items()->create([
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['subtotal']
            ]);
            $product = Product::findOrFail($item['id']);
            $product->update([
                'stock' => $product->stock - $item['qty']
            ]);
        }

        session()->forget('cart');
        $this->reset();

        $this->successNotify('Success', 'Transaction Created');
        return $this->redirect(route('transactions.detail', $transaction), navigate: true);
    }

    public function render()
    {
        return view('livewire.transaction.cart');
    }
}
