<?php

declare(strict_types=1);

namespace Deacero\Api\Product\Domain;

final class Product
{
    public function __construct(
        private string $id,
        private string $name,
        private string $description,
        private string $category,
        private int $price,
        private string $sku,
    ) {
    }

    public static function create(
        string $id,
        string $name,
        string $description,
        string $category,
        int $price,
        string $sku,
    ): self {
        $product = self::fromPrimitives(
            id:          $id,
            name:        $name,
            description: $description,
            category:    $category,
            price:       $price,
            sku:         $sku,
        );

        return $product;
    }

    public function update(
        string $name,
        string $description,
        string $category,
        int $price,
        string $sku,
    ): void {
        $this->name        = $name;
        $this->description = $description;
        $this->category    = $category;
        $this->price       = $price;
        $this->sku         = $sku;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function category(): string
    {
        return $this->category;
    }

    public function price(): int
    {
        return $this->price;
    }

    public function sku(): string
    {
        return $this->sku;
    }

    public static function fromPrimitives(
        string $id,
        string $name,
        string $description,
        string $category,
        int $price,
        string $sku,
    ): self {
        return new self(
            id:          $id,
            name:        $name,
            description: $description,
            category:    $category,
            price:       $price,
            sku:         $sku,
        );
    }
}
