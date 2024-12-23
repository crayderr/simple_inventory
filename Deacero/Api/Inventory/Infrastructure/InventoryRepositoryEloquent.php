<?php

declare(strict_types=1);

namespace Deacero\Api\Inventory\Infrastructure;


use App\Models\Inventory as InventoryModel;
use App\Models\InventoryMovement as InventoryMovementModel;
use Deacero\Api\Inventory\Domain\Inventory;
use Deacero\Api\Inventory\Domain\InventoryMovement;
use Deacero\Api\Inventory\Domain\InventoryRepository;

class InventoryRepositoryEloquent implements InventoryRepository
{
    public function create(Inventory $inventory): void
    {
        InventoryModel::create([
            'id'            => $inventory->id(),
            'product_id'    => $inventory->productId(),
            'store_id'      => $inventory->storeId(),
            'quantity'      => $inventory->quantity(),
            'min_quantity'  => $inventory->minQuantity(),
        ]);
    }

    public function createMovement(InventoryMovement $inventoryMovement): void
    {
        InventoryMovementModel::create([
            'id'              => $inventoryMovement->id(),
            'product_id'      => $inventoryMovement->productId(),
            'source_store_id' => $inventoryMovement->sourceStoreId(),
            'target_store_id' => $inventoryMovement->targetStoreId(),
            'quantity'        => $inventoryMovement->quantity(),
            'type'            => $inventoryMovement->type()->name(),
            'timestamp'       => $inventoryMovement->timestamp(),
        ]);
    }

    public function updateQuantity(Inventory $inventory): void
    {
        InventoryModel::where('id', $inventory->id())->update([
            'quantity' => $inventory->quantity(),
        ]);
    }

    public function find(string $id): Inventory
    {
        $inventory = InventoryModel::find($id);

        return Inventory::create(
            $inventory->id,
            $inventory->product_id,
            $inventory->store_id,
            $inventory->quantity,
            $inventory->min_quantity,
        );
    }

    public function findStoreInventoryById(string $id): Inventory
    {
        $inventory = InventoryModel::where('store_id', $id)->first();

        return Inventory::create(
            id:             $inventory->id,
            productId:      $inventory->product_id,
            storeId:        $inventory->store_id,
            quantity:       $inventory->quantity,
            minQuantity:    $inventory->min_quantity,
        );
    }
}