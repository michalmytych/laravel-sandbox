<?php

namespace App\Services\Shop;

use App\Models\Shop\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function all(): Collection
    {
        return Product::latest()->get();
    }

    public function find(Product $product): Product
    {
        return $product;
    }
}