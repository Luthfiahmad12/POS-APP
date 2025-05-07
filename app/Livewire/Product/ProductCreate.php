<?php

namespace App\Livewire\Product;

use App\Livewire\Forms\ProductForm;
use App\Traits\DispatchNotificationTrait;
use Livewire\Component;

class ProductCreate extends Component
{
    use DispatchNotificationTrait;

    public ProductForm $form;

    public function save()
    {
        $this->form->store();
        $this->successNotify('Success', 'Product Created');
        return $this->redirect(route('products.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.product.product-create');
    }
}
