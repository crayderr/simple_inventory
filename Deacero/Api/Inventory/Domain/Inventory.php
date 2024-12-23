<?php

declare(strict_types=1);

namespace Deacero\Api\Inventory\Domain;

final class Inventory
{
    public function __construct(
        private string $id,
        private string $productId,
        private string $storeId,
        private string $quantity,
        private int $minQuantity,
    ) {
    }

    public static function create(
        string $id,
        string $productId,
        string $storeId,
        string $quantity,
        int $minQuantity,
    ): self {
        $product = self::fromPrimitives(
            id:          $id,
            productId:   $productId,
            storeId:     $storeId,
            quantity:    $quantity,
            minQuantity: $minQuantity,
        );

        return $product;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function productId(): string
    {
        return $this->productId;
    }

    public function storeId(): string
    {
        return $this->storeId;
    }

    public function quantity(): string
    {
        return $this->quantity;
    }

    public function minQuantity(): int
    {
        return $this->minQuantity;
    }

    public static function fromPrimitives(
        string $id,
        string $productId,
        string $storeId,
        string $quantity,
        int $minQuantity,
    ): self {
        return new self(
            id:          $id,
            productId:   $productId,
            storeId:     $storeId,
            quantity:    $quantity,
            minQuantity: $minQuantity,
        );
    }
}
