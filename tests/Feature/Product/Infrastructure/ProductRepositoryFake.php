<?php

declare(strict_types=1);

namespace Tests\Feature\Product\Infrastructure;

use Deacero\Api\Product\Domain\Product;
use Deacero\Api\Product\Domain\ProductRepository;

class ProductRepositoryFake implements ProductRepository
{
    public array $inMemoryProducts = [];
    public bool $createWasCalled = false;
    public bool $updateWasCalled = false;

    public function __construct()
    {
        $this->inMemoryProducts = [];
    }

    public function create(Product $product): void
    {
        $this->inMemoryProducts[$product->id()] = $product;
        $this->createWasCalled = true;
    }

    public function find(string $id): Product
    {
        return $this->inMemoryProducts[$id];
    }

    public function update(Product $product): void
    {
        $this->inMemoryProducts[$product->id()] = $product;
        $this->updateWasCalled = true;
    }
}