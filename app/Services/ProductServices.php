<?php

namespace App\Services;

use App\Models\Product;

class ProductServices
{
    public function create(array $data)
    {
        return Product::create($data);
    }
}
