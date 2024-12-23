<?php

declare(strict_types=1);

namespace Deacero\Api\Inventory\Application;

use DateTimeImmutable;
use Deacero\Api\Inventory\Domain\InventoryMovement;
use Deacero\Api\Inventory\Domain\InventoryRepository;
use Deacero\Api\Inventory\Domain\ValueObject\TypeMovement;


final class InventoryMovementCreator
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

        $sourceStore = $this->repository->findStoreInventoryById($sourceStoreId);
        $targetStore = $this->repository->findStoreInventoryById($targetStoreId);

        if ($sourceStore->quantity() < $quantity) {
            throw new \Exception('The quantity to transfer is greater than the quantity in stock');
        }

        if ($targetStore->productId() !== $productId) {
            throw new \Exception('The product does not exist in the target store');
        }

        $inventoryMovement = InventoryMovement::create(
            id:             $id,
            productId:      $productId,
            sourceStoreId:  $sourceStoreId,
            targetStoreId:  $targetStoreId,
            quantity:       $quantity,
            timestamp:      (new DateTimeImmutable())->format('Y-m-d H:i:s'),
            type:           TypeMovement::transfer()->name(),
        );

        $this->repository->createMovement($inventoryMovement);
    }
}
