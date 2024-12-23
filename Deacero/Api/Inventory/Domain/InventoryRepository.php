<?php

declare(strict_types=1);

namespace Deacero\Api\Inventory\Domain;

use Deacero\Api\Inventory\Domain\InventoryMovement;

interface InventoryRepository
{
    public function create(Inventory $inventory): void;
    public function createMovement(InventoryMovement $inventoryMovement): void;
    public function updateQuantity(Inventory $inventory): void;
    public function find(string $id): Inventory;
    public function findStoreInventoryById(string $id): Inventory;
}
