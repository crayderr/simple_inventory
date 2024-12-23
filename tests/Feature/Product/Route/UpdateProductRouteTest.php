<?php

namespace Tests\Product\Unit;

use App\Models\User;
use Tests\Factories\ProductFactory;
use Illuminate\Foundation\Testing\TestCase;
use Deacero\Api\Product\Domain\ProductRepository;


class UpdateProductRouteTest extends TestCase
{
    private ProductRepository $productRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productRepository = app(ProductRepository::class);
    }

    public function testRouteGetProducts()
    {
        /**
         * Preparing
         */
        $this->withExceptionHandling();

        $user   = User::factory()->create();
        $this->actingAs($user);

        $product = ProductFactory::create();
        $this->productRepository->create($product);

        $randomProduct = ProductFactory::create();
        $this->productRepository->create($randomProduct);

        /**
         * Actions
         */
        $response = $this->json('PUT', '/api/products' . '/' . $product->id(), [
            'name'          => $randomProduct->name(),
            'description'   => $randomProduct->description(),
            'category'      => $randomProduct->category(),
            'price'         => $randomProduct->price(),
            'sku'           => $randomProduct->sku(),
        ]);

        /**
         * Assert
         */
        $response->assertStatus(200);

        $product = $this->productRepository->find($product->id());

        $this->assertEquals($randomProduct->name(), $product->name());
    }
}
