<?php

namespace Tests\Feature\Store\Route;

use App\Models\User;
use Tests\Factories\ProductFactory;
use Tests\Factories\InventoryFactory;
use Illuminate\Foundation\Testing\TestCase;
use Deacero\Api\Product\Domain\ProductRepository;
use Deacero\Api\Inventory\Domain\InventoryRepository;


class GetStoreInventoryRouteTest extends TestCase
{
    private ProductRepository $productRepository;
    private InventoryRepository $inventoryRepository;
    protected function setUp(): void
    {
        parent::setUp();
        $this->productRepository = app(ProductRepository::class);
        $this->inventoryRepository = app(InventoryRepository::class);
    }

    public function testRouteGetStoreInventory()
    {
        /**
         * Preparing
         */
        $this->withExceptionHandling();

        $user   = User::factory()->create();
        $this->actingAs($user);

        for ($i = 0; $i < 5; $i++) {
            $product = ProductFactory::create();
            $this->productRepository->create($product);
        }

        $inventory = InventoryFactory::create([
            'product_id'    => $product->id(),
        ]);
        $this->inventoryRepository->create($inventory);

        /**
         * Actions
         */
        $response = $this->json('GET', '/api/stores/' . $inventory->storeId() . '/inventory');

        /**
         * Assert
         */
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'store_id',
                    'product_id',
                    'quantity',
                ]
            ]
        ]);

        $responseData = $response->json('data');
        $this->assertNotEmpty($responseData[0]);
        $this->assertEquals($inventory->storeId(), $responseData[0]['store_id']);
    }
}
