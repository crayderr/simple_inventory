<?php

namespace Tests\Product\Unit;

use App\Models\User;
use Tests\Factories\InventoryFactory;
use Illuminate\Foundation\Testing\TestCase;
use Deacero\Api\Inventory\Domain\InventoryRepository;


class GetInventoryStockLowRouteTest extends TestCase
{
    private InventoryRepository $inventoryRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->inventoryRepository = app(InventoryRepository::class);
    }

    public function testRouteGetProducts()
    {
        /**
         * Preparing
         */
        $this->withExceptionHandling();

        $user   = User::factory()->create();
        $this->actingAs($user);

        for ($i = 0; $i < 50; $i++) {
            $inventory = InventoryFactory::create();
            $this->inventoryRepository->create($inventory);
        }

        /**
         * Actions
         */
        $response = $this->json('GET', '/api/inventory/alerts');

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
                    'quantity',
                ]
            ]
        ]);

        $responseData = $response->json('data');
        $this->assertNotEmpty($responseData[0]);
    }
}
