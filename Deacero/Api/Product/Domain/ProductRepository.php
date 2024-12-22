<?php

declare(strict_types=1);

namespace Deacero\Api\Product\Domain;

interface ProductRepository
{
    public function create(Product $product): void;
    public function find(string $id): Product;
    public function update(Product $product): void;
    public function delete(Product $product): void;
}
