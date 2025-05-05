<?php

namespace App\Livewire\Transaction;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class TransactionCreate extends Component
{

    public $cartCount = 0;

    public function mount()
    {
        // Set cartCount berdasarkan session saat komponen pertama kali dimuat
        $this->cartCount = count(session()->get('cart', []));
    }

    // update cart count
    #[On(['cart-cleared', 'item-removed'])]
    public function updateCartCount()
    {
        $this->cartCount = count(session()->get('cart', []));
    }

    public function addToCart(string $id)
    {
        $product = Product::find($id);

        $cart = session()->get('cart', []);

        $index = collect($cart)->search(fn($item) => $item['id'] == $product->id);

        if ($index !== false) {
            $cart[$index]['qty'] += 1;
            $cart[$index]['subtotal'] = $cart[$index]['price'] * $cart[$index]['qty']; // Update subtotal
        } else {
            $cart[] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'subtotal' => $product->price * 1,
                'qty' => 1,
            ];

            $this->cartCount++;
        }

        session()->put('cart', $cart);

        $this->dispatch('cart-added', $cart);
    }

    public function render()
    {
        return view('livewire.transaction.transaction-create', [
            'products' => Product::available()->active()->get()
        ]);
    }
}
