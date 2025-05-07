<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Traits\DispatchNotificationTrait;
use Livewire\Component;

class ProductIndex extends Component
{
    use DispatchNotificationTrait;

    public function destroy(string $id)
    {
        Product::findOrFail($id)->delete();
        $this->warningNotify('Notice!', 'Product Deleted');
    }

    public function render()
    {
        return view('livewire.product.product-index', [
            'products' => Product::latest()->get()
        ]);
    }
}
