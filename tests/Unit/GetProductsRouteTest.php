<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\Factories\ProductFactory;
use Illuminate\Foundation\Testing\TestCase;
use Deacero\Api\Product\Domain\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;


class GetProductsRouteTest extends TestCase
{
    use RefreshDatabase;
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
        $this->actingAs(User::find(1));

        for ($i = 0; $i < 5; $i++) {
            $product = ProductFactory::create();
            $this->productRepository->create($product);
        }

        /**
         * Actions
         */
        $response = $this->json('GET', '/api/products');

        /**
         * Assert
         */
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'description',
                    'category',
                    'price',
                    'sku',
                ]
            ]
        ]);
    }
}
