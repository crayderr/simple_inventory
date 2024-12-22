<?php

declare(strict_types=1);

namespace Deacero\Api\Product\Domain;

interface ProductRepository
{
    public function create(Product $product): void;
}
