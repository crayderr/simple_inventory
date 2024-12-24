<?php

namespace Tests\Feature\Product\Route;

use App\Models\User;
use Tests\Factories\ProductFactory;
use Illuminate\Foundation\Testing\TestCase;
use Deacero\Api\Product\Domain\ProductRepository;

class DeleteProductRouteTest extends TestCase
{
    private ProductRepository $productRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productRepository = app(ProductRepository::class);
    }

    public function testRouteDeleteProduct()
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
        $response = $this->json('DELETE', '/api/products' . '/' . $product->id());

        /**
         * Assert
         */
        $response->assertStatus(200);
    }
}
