<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{
    public $name;
    public $price;
    public $stock;
    public $description;
    public $is_active;

    public ?Product $product;

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('products')->ignore($this->product ?? null)
            ],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be a string.',
            'name.min' => 'The product name must be at least :min characters long.',
            'name.max' => 'The product name cannot exceed :max characters.',

            'price.required' => 'The price is required.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price must be a non-negative number.',

            'stock.required' => 'The stock quantity is required.',
            'stock.integer' => 'The stock quantity must be a whole number.',
            'stock.min' => 'The stock quantity must be zero or more.',

            'description.string' => 'The description must be a string.',
            'description.max' => 'The description cannot exceed :max characters.',

            'is_active.required' => 'The active status is required.',
            'is_active.boolean' => 'The active status must be true or false.',
        ];
    }

    public function store()
    {
        $data = array_merge($this->validate(), [
            'sku' => 'SKU-' . strtoupper(Str::random(6)),
        ]);

        Product::create($data);
    }

    public function setData(?Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->description = $product->description;
        $this->is_active = $product->is_active;
    }

    public function update()
    {
        $this->product->update($this->validate());
    }
}
