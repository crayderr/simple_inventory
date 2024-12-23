<?php

declare(strict_types=1);

namespace Deacero\Api\Inventory\Infrastructure;


use App\Models\Inventory as InventoryModel;
use Deacero\Api\Inventory\Domain\Inventory;
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
}