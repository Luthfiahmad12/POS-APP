<?php

namespace App\Livewire\Transaction;

use App\Models\Product;
use App\Models\Transaction;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
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
        } else {
            echo 'error';
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
    }

    public function bulkDelete()
    {
        session()->forget('cart');
        $this->cart = [];
        $this->cartTotal = 0;
        $this->dispatch('cart-cleared');
    }

    public function createTransaction()
    {
        $transaction = new Transaction();
        $transaction->invoice_number = 'INV-' . rand(00000, 99999);
        $transaction->total_price = $this->cartTotal;
        $transaction->save();

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

        return $this->redirect(route('transactions.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.transaction.cart');
    }
}
