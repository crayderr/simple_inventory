<?php

namespace Tests\Product\Unit;

use App\Models\User;
use Tests\Factories\ProductFactory;
use Tests\Factories\InventoryFactory;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Deacero\Api\Product\Domain\ProductRepository;
use Deacero\Api\Inventory\Domain\InventoryRepository;

class InventoryMovementRouteTest extends TestCase
{
    use WithFaker;
    private ProductRepository $productRepository;
    private InventoryRepository $inventoryRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productRepository = app(ProductRepository::class);
        $this->inventoryRepository = app(InventoryRepository::class);
    }

    public function testRouteInventoryMovement()
    {
        /**
         * Preparing
         */
        $this->withExceptionHandling();

        $user   = User::factory()->create();
        $this->actingAs($user);

        $product = ProductFactory::create();
        $this->productRepository->create($product);

        $storeOneId = (string) \Faker\Factory::create()->uuid();
        $storeTwoId = (string) \Faker\Factory::create()->uuid();

        $startInventory = $this->faker->numberBetween(1, 100);
        $inventory = InventoryFactory::create([
            'product_id' => $product->id(),
            'quantity'   => $startInventory,
            'store_id'   => $storeOneId,
        ]);

        $startInventoryTwo = $this->faker->numberBetween(1, 100);
        $inventoryTwo = InventoryFactory::create([
            'product_id' => $product->id(),
            'quantity'   => $startInventoryTwo,
            'store_id'   => $storeTwoId,
        ]);
        $this->inventoryRepository->create($inventory);
        $this->inventoryRepository->create($inventoryTwo);

        /**
         * Actions
         */
        $randomQuantity = $this->faker->numberBetween(1, 9);
        $response = $this->json('POST', '/api/inventory/transfer', [
            'product_id'        => $product->id(),
            'source_store_id'   => $storeOneId,
            'target_store_id'   => $storeTwoId,
            'quantity'          => $randomQuantity,
        ]);

        /**
         * Assert
         */
        $response->assertStatus(201);

        $currentInventory = $this->inventoryRepository->findStoreInventoryById($storeOneId);
        $currentInventoryTwo = $this->inventoryRepository->findStoreInventoryById($storeTwoId);

        assert($currentInventory->quantity() === $startInventory - $randomQuantity);
        assert($currentInventoryTwo->quantity() === $startInventoryTwo + $randomQuantity);
    }
}
