<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;

class ProductIndex extends Component
{
    public function render()
    {
        return view('livewire.product.product-index', [
            'products' => Product::latest()->get()
        ]);
    }
}
