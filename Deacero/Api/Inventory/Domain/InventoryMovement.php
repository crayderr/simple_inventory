<?php

declare(strict_types=1);

namespace Deacero\Api\Inventory\Domain;

use DateTimeImmutable;
use Deacero\Api\Inventory\Domain\ValueObject\TypeMovement;

final class InventoryMovement
{
    public function __construct(
        private string $id,
        private string $productId,
        private string $sourceStoreId,
        private string $targetStoreId,
        private int $quantity,
        private DateTimeImmutable $timestamp,
        private TypeMovement $type,
    ) {
    }

    public static function create(
        string $id,
        string $productId,
        string $sourceStoreId,
        string $targetStoreId,
        int $quantity,
        string $timestamp,
        string $type,
    ): self {
        $inventoryMovement = self::fromPrimitives(
            id:            $id,
            productId:     $productId,
            sourceStoreId: $sourceStoreId,
            targetStoreId: $targetStoreId,
            quantity:      $quantity,
            timestamp:     $timestamp,
            type:          $type
        );

        return $inventoryMovement;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function productId(): string
    {
        return $this->productId;
    }

    public function sourceStoreId(): string
    {
        return $this->sourceStoreId;
    }

    public function targetStoreId(): string
    {
        return $this->targetStoreId;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }

    public function timestamp(): DateTimeImmutable
    {
        return $this->timestamp;
    }

    public function type(): TypeMovement
    {
        return $this->type;
    }

    public static function fromPrimitives(
        string $id,
        string $productId,
        string $sourceStoreId,
        string $targetStoreId,
        int $quantity,
        string $timestamp,
        string $type,
    ): self {
        return new self(
            id:            $id,
            productId:     $productId,
            sourceStoreId: $sourceStoreId,
            targetStoreId: $targetStoreId,
            quantity:      $quantity,
            timestamp:     new DateTimeImmutable($timestamp),
            type:          TypeMovement::create($type)
        );
    }
}
