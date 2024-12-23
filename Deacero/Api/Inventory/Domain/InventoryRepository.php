<?php

declare(strict_types=1);

namespace Deacero\Api\Inventory\Domain;

interface InventoryRepository
{
    public function create(Inventory $inventory): void;
    public function find(string $id): Inventory;
}
