<?php

declare(strict_types=1);

namespace Tests\Feature\Product\Infrastructure;

use Deacero\Api\Product\Domain\Product;
use Deacero\Api\Product\Domain\ProductRepository;

class ProductRepositoryFake implements ProductRepository
{
    public array $inMemoryProducts = [];
    public bool $createWasCalled = false;

    public function __construct()
    {
        $this->inMemoryProducts = [];
    }

    public function create(Product $category): void
    {
        $this->inMemoryProducts[] = $category;
        $this->createWasCalled = true;
    }
}