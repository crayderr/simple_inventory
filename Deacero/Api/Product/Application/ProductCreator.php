<?php

declare(strict_types=1);

namespace Deacero\Api\Product\Application;

use Deacero\Api\Product\Domain\Product;
use Deacero\Api\Product\Domain\ProductRepository;


final class ProductCreator
{
    public function __construct(
        private readonly ProductRepository $repository
    ) {
    }

    public function handle(
        string $id,
        string $name,
        string $description,
        string $category,
        int $price,
        string $sku,
    ): void {
        $product = Product::create(
            id:          $id,
            name:        $name,
            description: $description,
            category:    $category,
            price:       $price,
            sku:         $sku,
        );

        $this->repository->create($product);
    }
}
