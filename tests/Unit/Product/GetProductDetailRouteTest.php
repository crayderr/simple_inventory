<?php

namespace Tests\Product\Unit;

use App\Models\User;
use Tests\Factories\ProductFactory;
use Illuminate\Foundation\Testing\TestCase;
use Deacero\Api\Product\Domain\ProductRepository;


class GetProductDetailRouteTest extends TestCase
{
    private ProductRepository $productRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productRepository = app(ProductRepository::class);
    }

    public function testRouteGetProductDetail()
    {
        /**
         * Preparing
         */
        $this->withExceptionHandling();

        $user   = User::factory()->create();
        $this->actingAs($user);

        $product = ProductFactory::create();
        $this->productRepository->create($product);

        /**
         * Actions
         */
        $response = $this->json('GET', '/api/products' . '/' . $product->id());

        /**
         * Assert
         */
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'category',
                'price',
                'sku',
            ],
        ]);

        $responseData = $response->json('data');

        $this->assertEquals($product->name(), $responseData['name']);
        $this->assertEquals($product->description(), $responseData['description']);
        $this->assertEquals($product->category(), $responseData['category']);
        $this->assertEquals($product->price(), $responseData['price']);
        $this->assertEquals($product->sku(), $responseData['sku']);

    }
}
