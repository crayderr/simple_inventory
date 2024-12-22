<?php

declare(strict_types=1);

namespace Deacero\Api\Product\Infrastructure;


use App\Models\Product as ProductModel;
use Deacero\Api\Product\Domain\Product;
use Deacero\Api\Product\Domain\ProductRepository;

class ProductRepositoryEloquent implements ProductRepository
{
    public function create(Product $category): void
    {
        ProductModel::create([
            'id'          => $category->id(),
            'name'        => $category->name(),
            'description' => $category->description(),
            'category'    => $category->category(),
            'price'       => $category->price(),
            'sku'         => $category->sku(),
        ]);
    }

    public function find(string $id): Product
    {
        $product = ProductModel::find($id);

        return Product::create(
            id:          $product->id,
            name:        $product->name,
            description: $product->description,
            category:    $product->category,
            price:       $product->price,
            sku:         $product->sku,
        );
    }

    public function update(Product $product): void
    {
        ProductModel::where('id', $product->id())
            ->update([
                'name'        => $product->name(),
                'description' => $product->description(),
                'category'    => $product->category(),
                'price'       => $product->price(),
                'sku'         => $product->sku(),
            ]);
    }
}