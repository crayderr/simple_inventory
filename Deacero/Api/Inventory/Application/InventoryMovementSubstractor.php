<?php

declare(strict_types=1);

namespace Deacero\Api\Inventory\Application;

use DateTimeImmutable;
use Deacero\Api\Inventory\Domain\InventoryMovement;
use Deacero\Api\Inventory\Domain\InventoryRepository;
use Deacero\Api\Inventory\Domain\ValueObject\TypeMovement;


final class InventoryMovementSubstractor
{
    public function __construct(
        private readonly InventoryRepository $repository
    ) {
    }

    public function handle(
        string $id,
        string $productId,
        string $sourceStoreId,
        string $targetStoreId,
        int $quantity,
    ): void {

        $inventoryMovement = InventoryMovement::create(
            id:             $id,
            productId:      $productId,
            sourceStoreId:  $sourceStoreId,
            targetStoreId:  $targetStoreId,
            quantity:       $quantity,
            timestamp:      (new DateTimeImmutable())->format('Y-m-d H:i:s'),
            type:           TypeMovement::out()->name(),
        );

        # TODO: normalmente esto lo abordaría desde caso de uso diferente
        $inventory = $this->repository->findStoreInventoryById($sourceStoreId);
        $inventory->substractQuantity($quantity);
        $this->repository->updateQuantity($inventory);

        $this->repository->createMovement($inventoryMovement);
    }
}
