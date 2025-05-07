<?php

namespace App\Livewire\Product;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use App\Traits\DispatchNotificationTrait;
use Livewire\Component;

class ProductEdit extends Component
{
    use DispatchNotificationTrait;

    public ProductForm $form;

    public $sku;

    public function mount(?Product $product)
    {
        $this->sku = $product->sku;
        $this->form->setData($product);
    }

    public function update()
    {
        $this->form->update();
        $this->infoNotify('Info', 'Product Updated');
        return $this->redirect(route('products.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.product.product-edit');
    }
}
