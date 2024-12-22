<?php

namespace Tests\Feature\Product\Application;


use Tests\TestCase;
use Tests\Factories\ProductFactory;
use Deacero\Api\Product\Domain\Product;
use Deacero\Api\Product\Application\ProductUpdater;
use Tests\Feature\Product\Infrastructure\ProductRepositoryFake;

class ProductUpdaterTest extends TestCase
{
    private Product $product;
    private ProductRepositoryFake $repository;

    function setUp(): void
    {
        $this->product = ProductFactory::create();
        $this->repository = new ProductRepositoryFake();
        $this->repository->create($this->product);
    }

    public function testProductCreatorService()
    {
        /**
         * Actions
         */
        $service = new ProductUpdater($this->repository);

        $service->handle(
            id:             $this->product->id(),
            name:           $this->product->name(),
            description:    $this->product->description(),
            category:       $this->product->category(),
            price:          $this->product->price(),
            sku:            $this->product->sku(),
        );

        /**
         * Asserts
         */
        $this->assertTrue($this->repository->updateWasCalled);
    }
}
